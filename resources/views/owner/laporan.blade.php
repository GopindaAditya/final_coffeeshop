@extends('layout.ownerLayout')

@section('container')
    <div class="header">
        <h1 style="color: #9D7942;">Monthly Finance</h3>
    </div>

    <div class="row mt-2">
        <div class="col-md-7" style ="background-color: #9D7942; padding:3vh;border-radius:2vh; width:100vh;">
            <div class="card" style="border:none">
                <div class="row mt-100">
                    <div class="col">
                        <div class="col">
                            <div id="canvasjsChartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3" style ="background-color: #9D7942; padding:3vh;border-radius:2vh; width:100vh;">
            <div class="chart-container" style ="background-color: white">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <button id="exportToExcelButton" class="btn btn-success">Export to Excel</button>
    </div>


    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.core.min.js"></script>
    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("canvasjsChartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Total Number of Transactions"
                },
                axisX: {
                    valueFormatString: "DD MMM",
                    intervalType: "day"
                },
                axisY: {
                    title: "Number of Transactions",
                    includeZero: true
                },
                data: [{
                    type: "line", // Mengganti tipe grafik menjadi "line"
                    color: "#6599FF",
                    xValueType: "dateTime",
                    xValueFormatString: "DD MMM",
                    yValueFormatString: "#,##0 Transactions",
                    dataPoints: <?php echo json_encode($penjualanData); ?>
                }]
            });
            chart.render();
        }
        // Ambil nama produk dari data yang dikirimkan dari controller
        const produkLabels = {!! json_encode($menu->pluck('name')) !!};
        const produkData = {!! json_encode($penjualanProduk) !!};

        // Data untuk Bar Chart
        const barChartData = {
            labels: produkLabels,
            datasets: [{
                backgroundColor: ["red", "green", "blue", "orange", "brown"],
                data: produkData,
            }],
        };

        // Data untuk Pie Chart
        // const pieChartData = {
        //     labels: produkLabels,
        //     datasets: [{
        //         backgroundColor: ["red", "green", "blue", "orange", "brown"],
        //         data: produkData,
        //     }],
        // };

        // Opsi untuk Bar Chart
        const barChartOptions = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Product Sold Bar Chart",
            },
        };

        // Opsi untuk Pie Chart
        const pieChartOptions = {
            legend: {
                display: true
            },
            title: {
                display: true,
                text: "Pie Chart Example",
            },
        };


        // Inisialisasi Bar Chart
        const barChartCtx = document.getElementById("barChart").getContext("2d");
        new Chart(barChartCtx, {
            type: "bar",
            data: barChartData,
            options: barChartOptions,
        });
        // Inisialisasi Pie Chart
        // const pieChartCtx = document.getElementById("pieChart").getContext("2d");
        // new Chart(pieChartCtx, {
        //     type: "pie",
        //     data: pieChartData,
        //     options: pieChartOptions,
        // });
    </script>

    <script>
        $(document).ready(function() {
            // Tangani klik tombol ekspor
            $("#exportToExcelButton").click(function() {
                // Mengirim permintaan ke controller untuk mendapatkan data
                $.ajax({
                    url: '/owner/cetakLaporan',
                    method: 'GET',
                    success: function(data) {
                        console.log(data);
                        // Data berhasil diambil, sekarang ekspor data ke Excel
                        exportToExcel(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Fungsi ekspor data ke Excel
            function exportToExcel(data) {
                // Buat objek Workbook baru
                var wb = XLSX.utils.book_new();
                // Konversi data ke format Excel
                var ws = XLSX.utils.json_to_sheet(data);
                // Tambahkan worksheet ke workbook
                XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
                // Simpan workbook sebagai file Excel
                XLSX.writeFile(wb, 'laporan_penjualan.xlsx');
            }
        });
    </script>
@endsection
