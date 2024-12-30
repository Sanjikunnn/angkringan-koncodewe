<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- Quick Links Section -->
                
                <div class="col-lg-6 col-md-6 footer-links">
                    <div class="list-unstyled">
                    @guest
                    <strong><a href="{{ route('login') }}"  class="footer-link">Login</a>
                    <strong><a href="{{ route('register') }}"  class="footer-link">Daftar</a>
                    @endguest
                @auth
                @if ($data['user']->role == 1)
                <strong><a href="/products"  class="footer-link">Admin</a>
                @elseif ($data['user']->role == 0)
                        <strong><a href="{{ route('carts.index') }}"  class="footer-link">Keranjang</a>
                        <strong><a href="{{ route('orders.index') }}"  class="footer-link">Pesanan</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                @csrf
                        <strong><a href="{{ route('logout') }}"  class="footer-link" onclick="event.preventDefault(); this.closest('form').submit(); return confirm('Apakah Anda yakin ingin logout?')">
                        Logout</a>
                    </div>
                </div>
                </form>
                @endauth

                <div class="col-lg-6 col-md-6 footer-contact">
                    <h3>Angkringan Koncodewe</h3>
                    <p>
                        Jl. Citra Raya Boulevard No.280,<br>
                        Ciakar, Kec. Panongan, Kabupaten Tangerang, Banten 15711, Indonesia<br><br>
                        <strong>Whatsapp&#9;:</strong> +62 858 6713 4588<br>
                        <strong>Email&#9;:</strong> koncodewe@gmail.com<br>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 footer-links">
                    <h4>Sosial Media Kami</h4>
                    <div class="social-links mt-3">
                        <a href="{{ route('home') }}" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="{{ route('home') }}" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="{{ route('home') }}" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="{{ route('home') }}" class="google-plus"><i class="bx bxl-skype"></i></a>
                        <a href="{{ route('home') }}" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->
