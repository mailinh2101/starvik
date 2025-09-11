        <!-- Information -->
        <section class="s-contact-information flat-spacing">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-7">
                        <div class="image mb-lg-0">
                            <img loading="lazy" width="820" height="755"
                                src="{{ asset('images/information/team.jpg') }}" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="infor-content">
                            <p class="title h1 fw-medium text-black">Thông tin liên hệ</p>
                            <ul class="infor-store">
                                <li>
                                    <h3 class="caption fw-semibold">Địa chỉ</h3>
                                    <p class="h3 mb-12">
                                        {{ config('seo.company.address') }}</p>
                                    <a href="https://www.google.com/maps?q=197+Nguyễn+Thị+Nhung,+Hiệp+Bình+Phước,+Thủ+Đức,+Hồ+Chí+Minh"
                                        target="_blank" class="tf-btn-line">
                                        <span class="h3 text-capitalize fw-semibold">
                                            Lấy chỉ đường
                                        </span>
                                        <i class="icon icon-arrow-top-right fs-20"></i>
                                    </a>
                                </li>
                                <li>
                                    <h3 class="caption fw-semibold">Liên hệ với chúng tôi</h3>
                                    <ul class="store-contact list-ver">
                                        <li>
                                            <i class="icon icon-phone"></i>
                                            <span class="br-line type-vertical"></span>
                                            <a href="tel:{{ config('seo.company.phone') }}" class="h3 link">{{ config('seo.company.phone') }}</a>
                                        </li>
                                        <li>
                                            <i class="icon icon-envelope-simple"></i>
                                            <span class="br-line type-vertical"></span>
                                            <a href="mailto:{{ config('seo.company.email') }}"
                                                class="h3 link">{{ config('seo.company.email') }}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <h5 class="caption fw-semibold">Social Media</h5>
                                    <ul class="tf-social-icon">
                                        <li>
                                            <a href="{{ config('seo.company.social.facebook') }}" target="_blank" class="social-facebook">
                                                <span class="icon"><i class="icon-fb"></i></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ config('seo.company.social.instagram') }}" target="_blank"
                                                class="social-instagram">
                                                <span class="icon"><i class="icon-instagram-logo"></i></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://x.com/" target="_blank" class="social-x">
                                                <span class="icon"><i class="icon-x"></i></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.tiktok.com/@shopgiadungperfekt" target="_blank" class="social-tiktok">
                                                <span class="icon"><i class="icon-tiktok"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Information -->
