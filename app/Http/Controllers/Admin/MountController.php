<?php

namespace Pterodactyl\Http\Controllers\Admin;

use Pterodactyl\Services\Admin\AdminActivityLogService;
use Ramsey\Uuid\Uuid;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Pterodactyl\Models\Nest;
use Illuminate\Http\Response;
use Pterodactyl\Models\Mount;
use Pterodactyl\Models\Location;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\MountFormRequest;
use Pterodactyl\Repositories\Eloquent\MountRepository;
use Pterodactyl\Contracts\Repository\NestRepositoryInterface;
use Pterodactyl\Contracts\Repository\LocationRepositoryInterface;

class MountController extends Controller
{
    /**
     * MountController constructor.
     */
    public function __construct(
        protected AlertsMessageBag $alert,
        protected NestRepositoryInterface $nestRepository,
        protected LocationRepositoryInterface $locationRepository,
        protected MountRepository $repository,
        protected ViewFactory $view,
        protected AdminActivityLogService $activityLogService
    ) {
    }

    /**
     * Return the mount overview page.
     */
    public function index(): View
    {
        return $this->view->make('admin.mounts.index', [
            'mounts' => $this->repository->getAllWithDetails(),
        ]);
    }

    /**
     * Return the mount view page.
     *
     * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function view(string $id): View
    {
        $nests = Nest::query()->with('eggs')->get();
        $locations = Location::query()->with('nodes')->get();

        $this->activityLogService->log(
            'admin.mounts.view',
            auth()->user()->id,
            'Viewed mount ' . $id
        );

        return $this->view->make('admin.mounts.view', [
            'mount' => $this->repository->getWithRelations($id),
            'nests' => $nests,
            'locations' => $locations,
        ]);
    }

    /**
     * Handle request to create new mount.
     *
     * @throws \Throwable
     */
    public function create(MountFormRequest $request): RedirectResponse
    {
        $model = (new Mount())->fill($request->validated());
        $model->forceFill(['uuid' => Uuid::uuid4()->toString()]);

        $model->saveOrFail();
        $mount = $model->fresh();

        $this->activityLogService->log(
            'admin.mounts.create',
            auth()->user()->id,
            'Created new mount ' . $mount->name
        );

        $this->alert->success('Mount was created successfully.')->flash();

        return redirect()->route('admin.mounts.view', $mount->id);
    }

    /**
     * Handle request to update or delete location.
     *
     * @throws \Throwable
     */
    public function update(MountFormRequest $request, Mount $mount): RedirectResponse
    {
        if ($request->input('action') === 'delete') {
            return $this->delete($mount);
        }

        $mount->forceFill($request->validated())->save();

        $this->activityLogService->log(
            'admin.mounts.update',
            auth()->user()->id,
            'Updated mount ' . $mount->name
        );

        $this->alert->success('Mount was updated successfully.')->flash();

        return redirect()->route('admin.mounts.view', $mount->id);
    }

    /**
     * Delete a location from the system.
     *
     * @throws \Exception
     */
    public function delete(Mount $mount): RedirectResponse
    {
        $mount->delete();

        $this->activityLogService->log(
            'admin.mounts.delete',
            auth()->user()->id,
            'Deleted mount ' . $mount->name
        );

        return redirect()->route('admin.mounts');
    }

    /**
     * Adds eggs to the mount's many-to-many relation.
     */
    public function addEggs(Request $request, Mount $mount): RedirectResponse
    {
        $validatedData = $request->validate([
            'eggs' => 'required|exists:eggs,id',
        ]);

        $eggs = $validatedData['eggs'] ?? [];
        if (count($eggs) > 0) {
            $mount->eggs()->attach($eggs);
        }

        $this->activityLogService->log(
            'admin.mounts.add_eggs',
            auth()->user()->id,
            'Added eggs to mount ' . $mount->name
        );

        $this->alert->success('Mount was updated successfully.')->flash();

        return redirect()->route('admin.mounts.view', $mount->id);
    }

    /**
     * Adds nodes to the mount's many-to-many relation.
     */
    public function addNodes(Request $request, Mount $mount): RedirectResponse
    {
        $data = $request->validate(['nodes' => 'required|exists:nodes,id']);

        $nodes = $data['nodes'] ?? [];
        if (count($nodes) > 0) {
            $mount->nodes()->attach($nodes);
        }

        $this->alert->success('Mount was updated successfully.')->flash();

        $this->activityLogService->log(
            'admin.mounts.add_nodes',
            auth()->user()->id,
            'Added nodes to mount ' . $mount->name
        );

        return redirect()->route('admin.mounts.view', $mount->id);
    }

    /**
     * Deletes an egg from the mount's many-to-many relation.
     */
    public function deleteEgg(Mount $mount, int $egg_id): Response
    {
        $mount->eggs()->detach($egg_id);

        $this->activityLogService->log(
            'admin.mounts.delete_egg',
            auth()->user()->id,
            'Deleted egg from mount ' . $mount->name
        );

        return response('', 204);
    }

    /**
     * Deletes a node from the mount's many-to-many relation.
     */
    public function deleteNode(Mount $mount, int $node_id): Response
    {
        $mount->nodes()->detach($node_id);

        $this->activityLogService->log(
            'admin.mounts.delete_node',
            auth()->user()->id,
            'Deleted node from mount ' . $mount->name
        );

        return response('', 204);
    }
}
