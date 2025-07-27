<div class="glass-card p-6 rounded-lg">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-network-wired text-accent-purple"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-100">Port Allocation Helper</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Game Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-200 mb-2">Game Type</label>
            <select id="gameType"
                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                <option value="">Select a game...</option>
                <option value="minecraft">Minecraft</option>
                <option value="rust">Rust</option>
                <option value="fivem">FiveM</option>
                <option value="ark">ARK</option>
                <option value="csgo">CS:GO</option>
            </select>
        </div>

        <!-- Port Range -->
        <div>
            <label class="block text-sm font-medium text-gray-200 mb-2">Starting Port</label>
            <input type="number" id="startPort"
                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                placeholder="e.g. 25565">
        </div>

        <!-- Allocation Count -->
        <div>
            <label class="block text-sm font-medium text-gray-200 mb-2">Number of Ports</label>
            <input type="number" id="portCount"
                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                placeholder="e.g. 100" value="100">
        </div>
    </div>

    <!-- Port Ranges Info -->
    <div class="mt-4 space-y-2">
        <div class="text-sm text-gray-400">Common Port Ranges:</div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="p-3 bg-background-darker rounded-lg">
                <div class="font-semibold text-white mb-1">Minecraft</div>
                <div class="text-sm text-gray-400">
                    Default: 25565<br>
                    Query: +1<br>
                    RCON: +2
                </div>
            </div>
            <div class="p-3 bg-background-darker rounded-lg">
                <div class="font-semibold text-white mb-1">Rust</div>
                <div class="text-sm text-gray-400">
                    Game: 28015<br>
                    RCON: +1<br>
                    App: +2
                </div>
            </div>
            <div class="p-3 bg-background-darker rounded-lg">
                <div class="font-semibold text-white mb-1">FiveM</div>
                <div class="text-sm text-gray-400">
                    Game: 30120<br>
                    Server: +1<br>
                    Web: +2
                </div>
            </div>
        </div>
    </div>

    <!-- Generated Range -->
    <div class="mt-4 p-4 bg-background-darker rounded-lg">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-400">Generated Range:</span>
                <span id="portRange" class="text-lg font-semibold text-white">-</span>
            </div>
            <button type="button" id="copyRange"
                class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                <i class="fas fa-copy mr-2"></i>Copy
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const gameType = document.getElementById('gameType');
        const startPort = document.getElementById('startPort');
        const portCount = document.getElementById('portCount');
        const portRange = document.getElementById('portRange');
        const copyRange = document.getElementById('copyRange');

        const defaultPorts = {
            'minecraft': 25565,
            'rust': 28015,
            'fivem': 30120,
            'ark': 27015,
            'csgo': 27015
        };

        gameType.addEventListener('change', function () {
            if (defaultPorts[this.value]) {
                startPort.value = defaultPorts[this.value];
                updatePortRange();
            }
        });

        function updatePortRange() {
            const start = parseInt(startPort.value);
            const count = parseInt(portCount.value);

            if (isNaN(start) || isNaN(count)) {
                portRange.textContent = '-';
                return;
            }

            const end = start + count - 1;
            portRange.textContent = `${start}-${end}`;
        }

        startPort.addEventListener('input', updatePortRange);
        portCount.addEventListener('input', updatePortRange);

        copyRange.addEventListener('click', function () {
            const range = portRange.textContent;
            if (range !== '-') {
                navigator.clipboard.writeText(range).then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        text: 'Port range copied to clipboard',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        background: '#1E1E30',
                        iconColor: '#4ADE80',
                        customClass: {
                            popup: 'bg-accent-purple/50',
                            title: 'text-white',
                            content: 'text-gray-200'
                        }
                    });
                });
            }
        });
    });
</script>
