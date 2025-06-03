<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Statistics Report</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 p-6">
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8 pb-6 border-b border-gray-200">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Financial Statistics Report</h1>
        <p class="text-gray-600">{{ now()->format('F d, Y') }}</p>
    </div>

    <!-- Balance Section -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Current Balance</h2>
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="text-sm font-medium text-gray-600">Total Balance</div>
                <div class="text-lg font-semibold text-gray-800">
                    ${{ number_format($lastMonth[1] - $lastMonth[0], 2) }}</div>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="text-sm font-medium text-gray-600">Total Income</div>
                <div class="text-lg font-semibold text-gray-800">${{ number_format($lastMonth[1], 2) }}</div>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="text-sm font-medium text-gray-600">Total Expenses</div>
                <div class="text-lg font-semibold text-gray-800">${{ number_format($lastMonth[0], 2) }}</div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Last Week Statistics -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Last Week Statistics</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Total Expenses</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($lastWeek[0], 2) }}</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Total Income</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($lastWeek[1], 2) }}</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Average Expense</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($avgLastWeek[1], 2) }}</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Average Income</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($avgLastWeek[0], 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Last Month Statistics -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Last Month Statistics</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Total Expenses</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($lastMonth[0], 2) }}</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Total Income</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($lastMonth[1], 2) }}</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Average Expense</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($avgLastMonth[1], 2) }}</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Average Income</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($avgLastMonth[0], 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Last Year Statistics -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Last Year Statistics</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Total Expenses</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($lastYear[0], 2) }}</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Total Income</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($lastYear[1], 2) }}</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Average Expense</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($avgLastYear[1], 2) }}</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Average Income</div>
                    <div class="text-lg font-semibold text-gray-800">${{ number_format($avgLastYear[0], 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="bg-blue-50 rounded-lg shadow-sm p-6 border border-blue-100">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Summary</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Net Income (Last Month)</div>
                    <div class="text-lg font-semibold text-gray-800">
                        ${{ number_format($lastMonth[1] - $lastMonth[0], 2) }}</div>
                </div>
                <div class="bg-white p-4 rounded-lg">
                    <div class="text-sm font-medium text-gray-600">Net Income (Last Year)</div>
                    <div class="text-lg font-semibold text-gray-800">
                        ${{ number_format($lastYear[1] - $lastYear[0], 2) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
