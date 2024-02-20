<x-app-layout>
    <!-- Flash Message Display Begin -->
    @if(session('success'))
    <div class="container mt-4">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
    @endif
    <!-- Flash Message Display End -->
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg spad" data-setbg="img/bg/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h3>Contact</h3>
                        <div class="bt-option">
                            <a href="./home.html">Home</a>
                            <span>Contact</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-text">
                        <div class="contact-title">
                            <p>Send the Author a message : )</p>
                        </div>
                        <div class="contact-form">
                            <div class="dt-leave-comment">
                                <form action="{{ route('contact.submit') }}" method="POST">
                                    @csrf
                                    <div class="input-list">
                                        <input type="text" name="name" placeholder="Name">
                                        <input type="text" name="email" placeholder="Email">
                                    </div>
                                    <textarea name="message" placeholder="Message"></textarea>
                                    <button type="submit">Submit</button>
                                </form>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
</x-app-layout>
