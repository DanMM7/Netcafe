</body>

<script>
    $(function() {
    $( "#button" ).click(function() {
        $( "#button" ).addClass( "onclic", 250, validate);
    });

    function validate() {
        setTimeout(function() {
        $( "#button" ).removeClass( "onclic" );
        $( "#button" ).addClass( "validate", 450, callback );
        }, 2250 );
    }
        function callback() {
        setTimeout(function() {
            $( "#button" ).removeClass( "validate" );
        }, 1250 );
        }
    });
</script>

<?php 
                        $sql5 = "SELECT COUNT(id) ordertype FROM orders";
                        $bar = mysqli_query($connection, $sql5); 
                        $b = mysqli_fetch_assoc($bar);
?>
<script>
    var ctx = document.getElementById('myBar').getContext('2d');
    var myBar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Cappuccino', 'Chicken Mayonnaise', 'Gourment Burger', 'Breakfast delight', 'Cake of the Day', 'Roasted Mushrooms'],
            datasets: [{
                label: 'Orders per Product',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
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

<?php 
                        $sql6 = "SELECT COUNT(id) ordertype FROM orders";
                        $pie = mysqli_query($connection, $sql6); 
                        $i = mysqli_fetch_assoc($pie);
?>
<script>
    var ctx = document.getElementById('myPie').getContext('2d');
    var myPie = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Meals', 'Hearted Meals', 'Breakfast', 'Beverages', 'Cool Beverages'],
            datasets: [{
                label: 'Orders per Category',
                data: [12, 19, 23, 36, 28],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
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

<?php 
                        $sql7 = "SELECT COUNT(id) ordertype FROM orders";
                        $lin = mysqli_query($connection, $sql7); 
                        $l = mysqli_fetch_assoc($lin);
?>
<script>
    var ctx = document.getElementById('myLine').getContext('2d');
    var myLine = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['April', 'May', 'June', 'July', 'August', 'September'],
            datasets: [{
                label: 'Orders per Period',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
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

<?php 
                        $sql8 = "SELECT COUNT(id) ordertype FROM orders";
                        $gra = mysqli_query($connection, $sql8); 
                        $g = mysqli_fetch_assoc($gra);
?>
<script>
    var ctx = document.getElementById('myBar1').getContext('2d');
    var myBar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['James', 'Tshepo', 'Sipho', 'Lisa', 'Paul', 'William'],
            datasets: [{
                label: 'Top Customer',
                data: [12, 9, 3, 5, 21, 8],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
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

</html>
