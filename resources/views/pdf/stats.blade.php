<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Statistics Report</title>
    <style>
        body {
            background-color: #f9fafb;
            padding: 1.5rem;
            font-family: system-ui, -apple-system, sans-serif;
        }
        .container {
            max-width: 56rem;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .header h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        .header p {
            color: #4b5563;
        }
        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
            margin-bottom: 1.5rem;
        }
        .card h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        .stat-box {
            background-color: #f9fafb;
            padding: 1rem;
            border-radius: 0.5rem;
        }
        .stat-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
        }
        .stat-value {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
        }
        .summary-card {
            background-color: #eff6ff;
            border-color: #dbeafe;
        }
        .summary-box {
            background-color: white;
            padding: 1rem;
            border-radius: 0.5rem;
        }
        .space-y {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Financial Statistics Report</h1>
        <p>{{ now()->format('F d, Y') }}</p>
    </div>

    <!-- Balance Section -->
    <div class="card">
        <h2>Current Balance</h2>
        <div class="grid-3">
            <div class="stat-box">
                <div class="stat-label">Total Balance</div>
                <div class="stat-value">${{ number_format($lastMonth[1] - $lastMonth[0], 2) }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Total Income</div>
                <div class="stat-value">${{ number_format($lastMonth[1], 2) }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Total Expenses</div>
                <div class="stat-value">${{ number_format($lastMonth[0], 2) }}</div>
            </div>
        </div>
    </div>

    <div class="space-y">
        <!-- Last Week Statistics -->
        <div class="card">
            <h2>Last Week Statistics</h2>
            <div class="grid-2">
                <div class="stat-box">
                    <div class="stat-label">Total Expenses</div>
                    <div class="stat-value">${{ number_format($lastWeek[0], 2) }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Income</div>
                    <div class="stat-value">${{ number_format($lastWeek[1], 2) }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Average Expense</div>
                    <div class="stat-value">${{ number_format($avgLastWeek[1], 2) }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Average Income</div>
                    <div class="stat-value">${{ number_format($avgLastWeek[0], 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Last Month Statistics -->
        <div class="card">
            <h2>Last Month Statistics</h2>
            <div class="grid-2">
                <div class="stat-box">
                    <div class="stat-label">Total Expenses</div>
                    <div class="stat-value">${{ number_format($lastMonth[0], 2) }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Income</div>
                    <div class="stat-value">${{ number_format($lastMonth[1], 2) }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Average Expense</div>
                    <div class="stat-value">${{ number_format($avgLastMonth[1], 2) }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Average Income</div>
                    <div class="stat-value">${{ number_format($avgLastMonth[0], 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Last Year Statistics -->
        <div class="card">
            <h2>Last Year Statistics</h2>
            <div class="grid-2">
                <div class="stat-box">
                    <div class="stat-label">Total Expenses</div>
                    <div class="stat-value">${{ number_format($lastYear[0], 2) }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Total Income</div>
                    <div class="stat-value">${{ number_format($lastYear[1], 2) }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Average Expense</div>
                    <div class="stat-value">${{ number_format($avgLastYear[1], 2) }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Average Income</div>
                    <div class="stat-value">${{ number_format($avgLastYear[0], 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="card summary-card">
            <h2>Summary</h2>
            <div class="grid-2">
                <div class="summary-box">
                    <div class="stat-label">Net Income (Last Month)</div>
                    <div class="stat-value">${{ number_format($lastMonth[1] - $lastMonth[0], 2) }}</div>
                </div>
                <div class="summary-box">
                    <div class="stat-label">Net Income (Last Year)</div>
                    <div class="stat-value">${{ number_format($lastYear[1] - $lastYear[0], 2) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
