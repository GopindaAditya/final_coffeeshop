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
    <div class="mt-3 d-flex justify-content-end fixed-bottom">
        <button id="exportToExcelButton" class="btn"
            style ="background-color: #9D7942; color:#ffff; margin-right:10vh; margin-bottom:3vh;">Export to Excel</button>
    </div>


    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.core.min.js"></script>
    <script>
        // window.onload = function() {
        //     var chart = new CanvasJS.Chart("canvasjsChartContainer", {
        //         animationEnabled: true,
        //         theme: "light2",
        //         title: {
        //             text: "Total Number of Transactions"
        //         },
        //         axisX: {
        //             valueFormatString: "DD MMM",
        //             intervalType: "day"
        //         },
        //         axisY: {
        //             title: "Number of Transactions",
        //             includeZero: true
        //         },
        //         data: [{
        //             type: "line", 
        //             color: "#6599FF",
        //             xValueType: "dateTime",
        //             xValueFormatString: "DD MMM",
        //             yValueFormatString: "#,##0 Transactions",
        //             dataPoints: <?php echo json_encode($penjualanData); ?>
        //         }]
        //     });
        //     chart.render();
        // }
        window.onload = function() {
            // Fungsi untuk mendapatkan tanggal dengan format DD MMM YYYY
            function getDateFormatted(date) {
                var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                return date.getDate() + ' ' + months[date.getMonth()];
            }

            // Generate dummy data
            var dummyData = [];
            var startDate = new Date(); 
            startDate.setDate(startDate.getDate()-7);
            for (var i = 0; i < 7; i++) {
                var currentDate = new Date(startDate);
                currentDate.setDate(startDate.getDate() + i); // Tambahkan i hari
                var formattedDate = getDateFormatted(currentDate);
                var transactions = Math.round(Math.random() * 10 + 5); // Angka acak antara 5 dan 15
                dummyData.push({
                    x: currentDate,
                    y: transactions,
                    label: formattedDate
                });
            }

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
                    type: "line",
                    color: "#6599FF",
                    xValueType: "dateTime",
                    xValueFormatString: "DD MMM",
                    yValueFormatString: "#,##0 Transactions",
                    dataPoints: dummyData
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
            // datasets: [{
            //     backgroundColor: ["red", "green", "blue", "orange", "brown"],
            //     data: produkData,
            // }],

            datasets: [{
                label: 'Dataset',
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"],
                data: [59, 78, 170, 57] // Sesuaikan dengan perbandingan yang diinginkan
            }]
        };


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

        // Inisialisasi Bar Chart
        const barChartCtx = document.getElementById("barChart").getContext("2d");
        console.log(barChartCtx);
        new Chart(barChartCtx, {
            type: "bar",
            data: barChartData,
            options: barChartOptions,
        });
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

            function exportToExcel(data) {
                // Dapatkan tahun saat ini
                var tahunSekarang = new Date().getFullYear();
                // Dapatkan nama bulan saat ini dalam bentuk teks (misalnya, "Januari")
                var bulanSekarang = new Date().toLocaleString('default', {
                    month: 'long'
                });

                // Buat objek Workbook baru
                var wb = XLSX.utils.book_new();
                // Konversi data ke format Excel
                var ws = XLSX.utils.json_to_sheet(data);
                // Tambahkan worksheet ke workbook
                XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

                // Buat nama file dengan format "laporan_penjualan_tahun_bulan.xlsx"
                var namaFile = 'laporan_penjualan_' + bulanSekarang.toLowerCase() + '_' + tahunSekarang + '.xlsx';

                // Simpan workbook sebagai file Excel dengan nama file yang telah dibuat
                XLSX.writeFile(wb, namaFile);
            }


        });
    </script>
@endsection
