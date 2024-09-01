<!-- Backdrop -->
<div id="sc-backdrop"
style="display: none;"
class=" fixed inset-0 z-[999999] bg-black bg-opacity-50"></div>

<!-- Notification Modal -->
<div id="sc"
style="display: none;"

class="fixed top-1/2 left-1/2 z-[9999999] px-6 py-4 text-center bg-white border border-gray-200 rounded-lg shadow-lg transform -translate-x-1/2 -translate-y-1/2 dark:bg-gray-800 dark:border-gray-700 animate-bounce-in">

    <!-- Success Icon -->
    <div class="flex justify-center mb-4">
        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2l4 -4m6 2a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z" />
        </svg>
    </div>

    <!-- Title -->
    <h5 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
        Purchase Successful!
    </h5>

    <!-- Description -->
    <p class="mb-4 text-gray-700 dark:text-gray-400">
        Thank you for your purchase. You can view the details in your transaction log.
    </p>

    <!-- Action Button -->
    <a href="{{ route('transactions.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400">
        View Transaction Log
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
        </svg>
    </a>

    <!-- Close Button -->
    <button id="close-sc" class="mt-4 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-500 border border-transparent rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400">
        Close
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
