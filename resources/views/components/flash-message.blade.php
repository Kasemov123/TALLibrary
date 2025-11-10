@if(session('success'))
    <div id="flash-message" class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-lg z-50 flex items-center justify-between">
        <span>{{ session('success') }}</span>
        <button onclick="document.getElementById('flash-message').remove()" class="ml-4 text-green-700 hover:text-green-900">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
    <script>
        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            if (msg) msg.remove();
        }, 10000);
    </script>
@endif

@if(session('error'))
    <div id="flash-error" class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-lg z-50 flex items-center justify-between">
        <span>{{ session('error') }}</span>
        <button onclick="document.getElementById('flash-error').remove()" class="ml-4 text-red-700 hover:text-red-900">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
    <script>
        setTimeout(() => {
            const msg = document.getElementById('flash-error');
            if (msg) msg.remove();
        }, 10000);
    </script>
@endif