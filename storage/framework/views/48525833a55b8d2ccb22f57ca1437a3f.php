<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body class="bg-gray-900 text-gray-200 font-sans">
    <div class="flex min-h-screen">
        <aside class="bg-gray-800 w-64">
            <div class="p-4 flex items-center">
                <h1 class="text-2xl font-bold text-white">PET-CO</h1>
            </div>
            <nav class="mt-10">
                <ul>
                    <li class="mt-4">
                        <a href="#" class="flex items-center py-2 px-4 text-white-400 hover:bg-gray-600 hover:text-white">
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="mt-4">
                        <a href="<?php echo e(url('products')); ?>" class="flex items-center py-2 px-4 text-white-400 hover:bg-gray-600 hover:text-white">
                            <span>Manage products</span>
                        </a>
                    </li>
                    <li class="mt-4">
                        <a href="<?php echo e(route('product.create')); ?>" class="flex items-center py-2 px-4 text-white-400 hover:bg-gray-600 hover:text-white">
                            <span>Add products</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 p-6">
            <header class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Dashboard</h2>
            </header>

            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold">Total Products</h3>
                    <p id="product-count" class="text-2xl mt-4">Loading...</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold">Total Customers</h3>
                    <p id="customer-count" class="text-2xl mt-4">Loading...</p>
                </div>
            </div>

            <div class="bg-gray-800 p-6 rounded-lg">
                <h3 class="text-xl font-semibold">Customers by Country</h3>
                <div id="piechart_3d" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>

    <script>
        // Function to get the base URL (handles both local and ngrok)
        function getBaseUrl() {
            // Check if the page is served over http://127.0.0.1 or localhost
            if (window.location.hostname === "127.0.0.1" || window.location.hostname === "localhost") {
                // For local development, we use the base of the local server
                return "http://127.0.0.1:8000"; // Change this if your local setup uses a different port
            } else {
                // For ngrok, we use the public ngrok URL
                return window.location.origin; // This will automatically use ngrok's https address
            }
        }

        // Function to fetch the product count
        function fetchProductCount() {
            const baseUrl = getBaseUrl();
            axios.get(`${baseUrl}/products/count`)
                .then(response => {
                    document.getElementById('product-count').innerText = response.data.count;
                })
                .catch(error => {
                    console.error("Error fetching product count:", error.response?.data || error.message);
                });
        }

        // Function to fetch the customer count
        function fetchCustomerCount() {
            const baseUrl = getBaseUrl();
            axios.get(`${baseUrl}/customers/count`)
                .then(response => {
                    document.getElementById('customer-count').innerText = response.data.count;
                })
                .catch(error => {
                    console.error("Error fetching customer count:", error.response?.data || error.message);
                });
        }

        // Function to draw the pie chart
        function drawChart() {
            const baseUrl = getBaseUrl();
            axios.get(`${baseUrl}/customers/countries`)
                .then(response => {
                    const customerData = response.data;
                    const chartData = [['Country', 'Customers']];

                    customerData.forEach(item => {
                        chartData.push([item.country, item.count]);
                    });

                    const data = google.visualization.arrayToDataTable(chartData);

                    const options = {
                        title: 'Customers by Country',
                        is3D: true,
                        backgroundColor: 'transparent',
                        titleTextStyle: { color: 'white' },
                        legendTextStyle: { color: 'white' }
                    };

                    const chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                })
                .catch(error => {
                    console.error("Error fetching customer country data:", error.response?.data || error.message);
                });
        }

        // Load Google Charts library and draw the chart
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        // Fetch product and customer data
        fetchProductCount();
        fetchCustomerCount();
    </script>

</body>
</html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Desktop folder\Uni coursework\Year 2\Sem 2\SSP II\PetCo\PetCo\resources\views\dashboard.blade.php ENDPATH**/ ?>