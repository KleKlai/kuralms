<x-custom-layout>
    @section('css')
        <style>
            .choose {
                transition: transform 0.2s ease;
                box-shadow: none;
              }

            .choose:hover {
                transform: scale(1.1);
                box-shadow: 0 0 20px rgba(33,33,33,.2);
            }
        </style>
    @stop

    <div class="row">
        <div class="col-lg-6 col-md-7 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-sm-12 text-center mb-4">
                        <h4 class="mr-2 font-weight-semibold pr-2 mr-2">What best describe you?</h4>
                    </div>
                    <a href="{{ route('set.role', 'teacher') }}" class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card text-decoration-none">
                        <div class="card rounded choose" style="background-image: url(https://source.unsplash.com/collection/54673041/600x200)">
                            <div class="card-body text-white">
                                    <div class="clearfix">
                                        <h3 class="font-weight-medium mb-0">Teacher</h3>
                                    </div>
                                    <p class="text-white mt-3 mb-0">
                                        A person who teaches, especially in a school.
                                    </p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('set.role', 'student') }}" class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card text-decoration-none">
                        <div class="card rounded choose" style="background-image: url(https://source.unsplash.com/collection/2090609/600x200)">
                            <div class="card-body text-white">
                                    <div class="clearfix">
                                        <h3 class="font-weight-medium mb-0">Student</h3>
                                    </div>
                                    <p class="text-white mt-3 mb-0">
                                        A person who is studying at a school.
                                    </p>
                            </div>
                        </div>
                    </a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

</x-custom-layout>
