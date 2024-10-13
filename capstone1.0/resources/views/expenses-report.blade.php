@extends('layouts.app')

@section('title', 'Expenses Report') 
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

@section('content') 
<div class="mb-4">
                <a href="{{ url('admin/dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> 
                </a>
            </div>
<div class="container">
    <div class="card">
        <h1>Expenses Report</h1>

        <!-- Date Range Form: POST method -->
        <form action="{{ route('expenses-report') }}" method="POST">
            @csrf
            <div>
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date', \Carbon\Carbon::now()->subDays(6)->toDateString()) }}" required>
            </div>
            <div>
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date', \Carbon\Carbon::now()->toDateString()) }}" required>
            </div>
            <button type="submit">Generate Report</button>
        </form>

        <!-- Chart -->
        <canvas id="expensesChart" style="max-width: 100%; height: 400px;"></canvas>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Check if the expenses data is being passed
        const expenses = @json($expenses ?? []);

        console.log(expenses); // Debug: Check the console if the data is passed

        // Only render the chart if expenses data is available
        if (expenses.length > 0) {
            const labels = expenses.map(expense => new Date(expense.date).toLocaleDateString());
            const data = expenses.map(expense => parseFloat(expense.total_expenses));

            const ctx = document.getElementById('expensesChart').getContext('2d');
            const expensesChart = new Chart(ctx, {
                type: 'line', // Change this to 'line' to create an area chart
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Expenses',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Light background color for the area
                        borderColor: 'rgba(75, 192, 192, 1)', // Border color for the line
                        borderWidth: 2,
                        fill: true, // Fill the area under the line
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'category',
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Expenses (₱)'
                            }
                        }
                    }
                }
            });
        } else {
            console.log('No expenses data found.');
        }
    </script>

<div class="card mt-4">
        <h2>Customer Feedback</h2>
        <ul>
            @if(isset($comments) && count($comments) > 0)
                @foreach($comments as $comment)
                    <li>
                        <strong>{{ $comment[0] ?? 'Anonymous' }}</strong>: {{ $comment[1] ?? 'No comment provided' }} ({{ $comment[2] ?? 'N/A' }})
                    </li>
                @endforeach
            @else
                <li>No comments available.</li>
            @endif
        </ul>
    </div>


@endsection <!-- End of the content section -->
