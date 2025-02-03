 <!-- Use the old layout here -->

<?php $__env->startSection('content'); ?>
<div class="flex">
    <!-- Sidebar -->
    <aside class="bg-gray-800 w-64 h-screen fixed top-0 left-0">
        <div class="p-4 flex items-center">
            <h1 class="text-2xl font-bold text-white">PET-CO</h1>
        </div>
        <nav class="mt-10">
            <div class="px-4 py-2">
                <h1 class="text-white-400 text-lg">Navigation</h1>
            </div>
            <ul>
                <li class="mt-4">
                    <a href="/" class="flex items-center py-2 px-4 text-white-400 hover:bg-gray-600 hover:text-white">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="mt-4">
                    <a href="<?php echo e(url('product/create')); ?>" class="flex items-center py-2 px-4 text-white-400 hover:bg-gray-600 hover:text-white">
                        <span>Add products</span>
                    </a>
                </li>
                <li class="mt-4">
                    <a href="<?php echo e(url('products')); ?>" class="flex items-center py-2 px-4 text-white-400 hover:bg-gray-600 hover:text-white">
                        <span>Manage products</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-64 p-10">
        <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 pt-10">
            <!-- Products will be displayed here -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.addEventListener("DOMContentLoaded", function() {
        // Make the Axios call to retrieve products
        axios.get('/api/products')
            .then(response => {
                const products = response.data;
                const productList = document.getElementById("product-list");

                if (products.length === 0) {
                    productList.innerHTML = '<p class="text-gray-400 text-lg text-center">No products available.</p>';
                    return;
                }

                // Loop through products and display them
                products.forEach(product => {
                    const productCard = document.createElement("div");
                    productCard.classList.add("bg-gray-800", "p-4", "shadow-md", "flex", "flex-col", "justify-between", "rounded-lg");

                    // Set the HTML for each product card
                    productCard.innerHTML = `
                        <div class="w-full h-48 overflow-hidden mb-4">
                            <img src="${product.pro_image_url}" alt="${product.pro_name}" class="w-full h-full object-contain">
                        </div>
                        <h3 class="font-bold text-md mb-1 text-white">${product.pro_name}</h3>
                        <p class="text-blue-400 text-lg font-bold mb-2">Rs. ${product.pro_price}</p>
                        <div class="flex items-center gap-2 mt-3">
                            <a href="<?php echo e(url('product/edit')); ?>/${product.id}" class="bg-blue-600 hover:bg-blue-500 text-white h-fit px-2 py-1 rounded-lg">Edit</a>
                            <button onclick="deleteProduct(${product.id}, this)" class="bg-red-600 hover:bg-red-500 text-white h-fit px-2 py-1 rounded-lg">Delete</button>
                        </div>
                    `;
                    productList.appendChild(productCard);
                });
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    });

    function deleteProduct(productId, btn) {
        if (confirm("Are you sure you want to delete this product?")) {
            axios.delete(`/api/products/${productId}`)
                .then(() => {
                    btn.closest("div.bg-gray-800").remove();
                })
                .catch(error => {
                    console.error('Error deleting product:', error);
                });
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.manage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Desktop folder\Uni coursework\Year 2\Sem 2\SSP II\PetCo\PetCo\resources\views\product\index.blade.php ENDPATH**/ ?>