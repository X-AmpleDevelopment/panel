<div class="glass-card p-6 rounded-lg">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-accent-purple/10 rounded-lg">
                <i class="fas fa-calculator text-accent-purple"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-100">Memory Calculator</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-200 mb-2">Value</label>
            <input type="number" id="memoryValue"
                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                placeholder="Enter value">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-200 mb-2">From</label>
            <select id="memoryFromUnit"
                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                <option value="B">Bytes (B)</option>
                <option value="KB">Kilobytes (KB)</option>
                <option value="MB">Megabytes (MB)</option>
                <option value="GB" selected>Gigabytes (GB)</option>
                <option value="TB">Terabytes (TB)</option>
                <option value="PB">Petabytes (PB)</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-200 mb-2">To</label>
            <select id="memoryToUnit"
                class="w-full px-3 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50">
                <option value="B">Bytes (B)</option>
                <option value="KB">Kilobytes (KB)</option>
                <option value="MB" selected>Megabytes (MB)</option>
                <option value="GB">Gigabytes (GB)</option>
                <option value="TB">Terabytes (TB)</option>
                <option value="PB">Petabytes (PB)</option>
            </select>
        </div>
    </div>

    <div class="mt-4 p-4 bg-background-darker rounded-lg">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-400">Result:</span>
                <span id="memoryResult" class="text-lg font-semibold text-white">0</span>
            </div>
            <button type="button" id="copyResult"
                class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                <i class="fas fa-copy mr-2"></i>Copy
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const valueInput = document.getElementById('memoryValue');
    const fromUnit = document.getElementById('memoryFromUnit');
    const toUnit = document.getElementById('memoryToUnit');
    const resultSpan = document.getElementById('memoryResult');
    const copyBtn = document.getElementById('copyResult');

    function convertMemory() {
        const value = parseFloat(valueInput.value);
        if (isNaN(value)) {
            resultSpan.textContent = '0';
            return;
        }

        const units = {
            'B': 0,
            'KB': 1,
            'MB': 2,
            'GB': 3,
            'TB': 4,
            'PB': 5
        };

        const fromPower = units[fromUnit.value];
        const toPower = units[toUnit.value];
        const difference = fromPower - toPower;

        let result;
        if (difference < 0) {
            result = value / Math.pow(1024, Math.abs(difference));
        } else {
            result = value * Math.pow(1024, difference);
        }

        result = Math.round(result * 100) / 100;
        resultSpan.textContent = `${result} ${toUnit.value}`;
    }

    // Update result when any input changes
    valueInput.addEventListener('input', convertMemory);
    fromUnit.addEventListener('change', convertMemory);
    toUnit.addEventListener('change', convertMemory);

    // Handle copy button click
    copyBtn.addEventListener('click', function() {
        const result = resultSpan.textContent.split(' ')[0]; // Get just the number
        navigator.clipboard.writeText(result).then(() => {
            // Show success notification
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: 'Value copied to clipboard',
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
    });
});
</script>
