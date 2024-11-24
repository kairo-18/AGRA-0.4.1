<div>
    <div id="bar-chart" style="height: 300px;"></div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                chart: {
                    type: 'bar',
                    height: 300
                },
                series: [{
                    name: 'Performance',
                    data: [1,2,3]
                }],
                xaxis: {
                    categories: [1,2,3]
                }
            };

            var chart = new ApexCharts(document.querySelector("#bar-chart"), options);
            chart.render();
        });
    </script>
@endpush
