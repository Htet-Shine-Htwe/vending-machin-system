<x-app-layout>
    <x-slot name="header">
        {{ __('Transaction Log') }}
    </x-slot>
    <div class="p-4 bg-white rounded-lg shadow-xs">


        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap order-collapse border border-slate-100">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="border px-4 py-3"></th>
                        <th class="border px-4 py-3">Ref Code</th>
                        <th class="border px-4 py-3">Total Items</th>
                        <th class="border px-4 py-3">Total Amount</th>
                        <th class="border px-4 py-3">Ordered At</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                    @foreach($transactions as $k=>$transaction)
                        <tr class="text-gray-700">
                            <td class="border px-4 py-3 text-sm">
                                {{ $k+1 }}
                            </td>
                            <td class="border px-4 py-3 text-sm">
                                {{ $transaction->reference }}
                            </td>
                            <td class="border px-8 py-3 text-sm">
                                {{ $transaction->products_count }}
                            </td>
                            <td class="border px-4 py-3 text-sm">
                               $ {{ $transaction->total_amount }}
                            </td>
                            <td class="border px-4 py-3 text-sm">
                                {{ $transaction->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $transactions->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
