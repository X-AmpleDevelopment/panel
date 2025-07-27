@extends('layouts.admin')

@section('title')
API Tester
@endsection

@section('content')
<div class="flex flex-col space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold text-gray-100">
            <div class="flex items-center space-x-4">
                <div class="p-2 bg-accent-purple/10 rounded-lg">
                    <i class="fas fa-code text-accent-purple"></i>
                </div>
                <div>
                    API Tester
                    <small class="block mt-1 text-base font-normal text-gray-400">Test your API endpoints and responses.</small>
                </div>
            </div>
        </h1>
    </div>

    <!-- API Tester Interface -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Request Panel -->
        <div class="glass-card p-6 space-y-6">
            <h2 class="text-xl font-semibold gradient-text">Request</h2>

            <!-- API Key Input -->
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2">API Key</label>
                <input type="password" id="apiKey"
                       class="w-full px-4 py-2 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring-1 focus:ring-accent-purple"
                       placeholder="Enter your API key">
            </div>

            <!-- Method Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2">Method</label>
                <select id="method"
                        class="w-full px-4 py-2 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring-1 focus:ring-accent-purple">
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                    <option value="PUT">PUT</option>
                    <option value="DELETE">DELETE</option>
                </select>
            </div>

            <!-- Endpoint Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2">Endpoint</label>
                <select id="endpoint"
                        class="w-full px-4 py-2 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring-1 focus:ring-accent-purple">
                    <option value="/api/client">Client Details</option>
                    <option value="/api/client/servers">List Servers</option>
                    <option value="/api/client/account">Account Details</option>
                    <option value="/api/client/account/two-factor">2FA Details</option>
                    <option value="/api/client/account/api-keys">API Keys</option>
                    <option value="/api/application/users">List Users</option>
                    <option value="/api/application/nodes">List Nodes</option>
                    <option value="/api/application/servers">List Servers</option>
                    <option value="/api/application/locations">List Locations</option>
                </select>
            </div>

            <!-- Request Body -->
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2">Request Body (JSON)</label>
                <textarea id="requestBody" rows="4"
                          class="w-full px-4 py-2 bg-background/50 text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring-1 focus:ring-accent-purple font-mono text-sm"
                          placeholder="{&#10;  &quot;key&quot;: &quot;value&quot;&#10;}"></textarea>
            </div>

            <!-- Send Button -->
            <button onclick="sendRequest()"
                    class="w-full px-6 py-3 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-all duration-300 flex items-center justify-center space-x-2">
                <i class="fas fa-paper-plane"></i>
                <span>Send Request</span>
            </button>
        </div>

        <!-- Response Panel -->
        <div class="glass-card p-6 space-y-6">
            <h2 class="text-xl font-semibold gradient-text">Response</h2>

            <!-- Status -->
            <div id="responseStatus" class="hidden">
                <label class="block text-sm font-medium text-gray-200 mb-2">Status</label>
                <div class="flex items-center space-x-3">
                    <div class="status-code px-3 py-1 rounded-lg text-sm font-medium"></div>
                    <div class="status-text text-sm"></div>
                </div>
            </div>

            <!-- Response Time -->
            <div id="responseTime" class="hidden">
                <label class="block text-sm font-medium text-gray-200 mb-2">Response Time</label>
                <div class="text-sm text-gray-400"></div>
            </div>

            <!-- Response Body -->
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2">Response Body</label>
                <pre id="responseBody"
                     class="w-full p-4 bg-background/50 text-white rounded-lg border border-gray-700 font-mono text-sm overflow-x-auto"
                     style="max-height: 400px;">
                    <code>No response yet...</code>
                </pre>
            </div>
        </div>
    </div>
</div>

<script>
function sendRequest() {
    const apiKey = document.getElementById('apiKey').value;
    const method = document.getElementById('method').value;
    const endpoint = document.getElementById('endpoint').value;
    const requestBody = document.getElementById('requestBody').value;

    // Show loading state
    Swal.fire({
        title: 'Sending Request...',
        html: 'Please wait while we process your request',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    const startTime = performance.now();

    // Make the request
    fetch(endpoint, {
        method: method,
        headers: {
            'Authorization': `Bearer ${apiKey}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: method !== 'GET' ? requestBody : undefined
    })
    .then(response => {
        const endTime = performance.now();
        const responseTime = Math.round(endTime - startTime);

        // Update status
        const statusEl = document.getElementById('responseStatus');
        statusEl.classList.remove('hidden');
        const statusCode = statusEl.querySelector('.status-code');
        const statusText = statusEl.querySelector('.status-text');

        statusCode.textContent = response.status;
        statusCode.className = `status-code px-3 py-1 rounded-lg text-sm font-medium ${
            response.ok ? 'bg-emerald-500/10 text-emerald-500' : 'bg-red-500/10 text-red-500'
        }`;
        statusText.textContent = response.statusText;

        // Update response time
        const responseTimeEl = document.getElementById('responseTime');
        responseTimeEl.classList.remove('hidden');
        responseTimeEl.querySelector('div').textContent = `${responseTime}ms`;

        return response.json();
    })
    .then(data => {
        // Update response body
        document.getElementById('responseBody').innerHTML =
            `<code>${JSON.stringify(data, null, 2)}</code>`;

        Swal.close();
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Request Failed',
            text: error.message
        });

        document.getElementById('responseBody').innerHTML =
            `<code class="text-red-500">${error.message}</code>`;
    });
}

// Add syntax highlighting for JSON
document.getElementById('requestBody').addEventListener('input', function(e) {
    try {
        const json = JSON.parse(e.target.value);
        e.target.value = JSON.stringify(json, null, 2);
    } catch (error) {
        // Invalid JSON, but that's okay during typing
    }
});
</script>

<style>
#responseBody {
    white-space: pre-wrap;
    word-wrap: break-word;
}

.status-code {
    font-family: monospace;
}
</style>
@endsection
