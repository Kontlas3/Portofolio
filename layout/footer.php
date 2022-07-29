<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; <?= date('Y'); ?> <div class="bullet"></div> Design By <a href="https://nauval.in/">Dukcapil</a>
    </div>
    <div class="footer-right">
        V 1.0
    </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.nicescroll.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>


<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<script src="assets/js/stisla.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table1').DataTable();
    });
</script>

<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php while ($row = mysqli_fetch_array($data_pengeluaran)) {
                            echo '"' . $row['jenis_pengeluaran'] . '",';
                        } ?>],
            datasets: [{
                label: 'Tabel Pengeluaran Kantor Dukcapil Luwu Tahun <?= date('Y'); ?>',
                data: [<?php while ($row = mysqli_fetch_array($pengeluaran)) {
                            echo '"' . $row['sold'] . '",';
                        } ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<!-- <script>
    swal({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success",
        button: "Aww yiss!",
    });
</script> -->

</body>

</html>