


 @extends('customer.layouts.master')
 @section('content')
 <div class="content" style="margin-top: 200px">

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">


          <div class="row justify-content-center">
            <div class="col-md-6">

              <h3 class="heading mb-4">Let's talk about everything!</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas debitis, fugit natus?</p>

              <p><img src="{{asset('customer/img/undraw-contact.svg')}}" alt="Image" class="img-fluid"></p>


            </div>
            <div class="col-md-6">

              <form class="mb-5" action="{{route('contactsent')}}" method="post" id="contactForm" name="contactForm">
                @csrf
                <input type="hidden" name="userid" value="{{Auth::user()->id}}">

                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="title" id="subject" placeholder="Enter your Title...">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <textarea class="form-control" name="message" id="message" cols="30" rows="7" placeholder="Write your message"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <input type="submit" value="Send Message" class="btn btn-outline-primary rounded-0 py-2 px-4">
                  <span class="submitting"></span>
                  </div>
                </div>
              </form>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>



 @endsection
