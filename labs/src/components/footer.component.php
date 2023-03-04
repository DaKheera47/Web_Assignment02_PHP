<?php
function createFooter()
{
    echo '
    <footer class="bg-uclan-blue text-white">
        <div class="grid grid-cols-3 gap-8 px-6 py-16 max-w-7xl mx-auto">
            <div>
                <h2 class="mb-6 text-lg font-semibold uppercase">
                    Navigation
                </h2>
                <ul class="">
                    <li class="mb-4">
                        <a href="#" class="link">Home</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="link">Products</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="link">Cart</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-lg font-semibold uppercase">
                    Contact
                </h2>
                <ul class="">
                    <li class="mb-4">
                        Email:
                        <a href="mailto:suinformation@uclan.ac.uk" class="link">suinformation@uclan.ac.uk</a>
                    </li>
                    <li class="mb-4">
                        Phone:
                        <a href="tel:+441772893000" class="link">+44 1772 89 3000</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-lg font-semibold uppercase">
                    Location
                </h2>
                <ul class="">
                    <li class="mb-4">
                        University of Central Lancashire Students" Union.
                        Fylde Road. Preston. PR1 7BY
                    </li>
                    <li class="mb-4">Company Number: 7623917</li>
                    <li class="mb-4">Registered Chanty Number: 1142616</li>
                </ul>
            </div>
        </div>
    </footer>
';
}
