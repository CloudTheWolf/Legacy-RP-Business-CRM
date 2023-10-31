<div class="px-2 py-2 min-h-[250px] max-h-[250px] overflow-y-auto">
    <div class="flex-auto p-6 content-center">
        <div class="flex content-center">
            <h6 class="mb-0 text-white">{{__('This Month Vs Last Month')}}</h6>
        </div>
        <table class="text-white content-center w-full">
            <thead>
            <tr class="bg-gray-500">
                <th></th>
                <th>🧰</th>
                <th>$</th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-gray-600">
                <th>This Month</th>
                <td> {{number_format($thisMonthCount,thousands_separator: ',') }}</td>
                <td>${{number_format($thisMonthIncome,thousands_separator: ',')}}</td>
            </tr>
            <tr>
                <th>Last Month</th>
                <td> {{number_format($lastMonthCount,thousands_separator: ',') }}</td>
                <td>${{number_format($lastMonthIncome,thousands_separator: ',') }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
