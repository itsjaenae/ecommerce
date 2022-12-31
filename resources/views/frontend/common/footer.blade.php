<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <!-- Contact Info-->
          <section class="widget widget-light-skin">
            <h3 class="widget-title" style="color: #000">{{__('Contact Us')}}</h3>
            <p class="mb-1"><strong>{{__('Address')}}: </strong> {{$setting->footer_address}}</p>
            <p class="mb-1"><strong>{{__('Phone')}}: </strong> {{$setting->footer_phone}}</p>
            <p class="mb-3"><strong>{{__('Email')}}: </strong> {{$setting->footer_email}}</p>
            <ul class="list-unstyled text-sm">
              <li><span class=""><strong>{{__('Monday-Friday')}}: </strong></span>{{$setting->friday_start}} - {{$setting->friday_end}}</li>
              <li><span class=""><strong>{{__('Saturday')}}: </strong></span>{{$setting->satureday_start}} - {{$setting->satureday_end}}</li>
            </ul>
            @php
            $links = json_decode($setting->social_link,true)['links'];
            $icons = json_decode($setting->social_link,true)['icons'];

          @endphp
            <div class="footer-social-links">
                @foreach ($links as $link_key => $link)
                <a href="{{$link}}"><span><i class="{{$icons[$link_key]}}"></i></span></a>
                @endforeach
            </div>
          </section>
        </div>
        <div class="col-lg-4 col-sm-6">
          <!-- Customer Info-->
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title"style="color: #000">{{__('Links')}}</h3>
            <ul>
                @if ($setting->is_faq == 1)
                <li class="{{ request()->routeIs('front.faq') ? 'active' : '' }}">
                    <a class="" href="{{route('front.faq')}}">{{__('Faq')}}</a>
                </li>
                @endif
                
                @if ($setting->is_contact == 1)
                <li class="{{ request()->routeIs('front.contacts') ? 'active' : '' }}">
                  <a href="{{route('front.contacts')}}">
                  {{__('Contact')}}</a></li>
            @endif

                @foreach (DB::table('pages')->wherePos(2)->orwhere('pos',1)->get() as $page)
                <li >
                  <a href="{{route('front.page',$page->slug)}}">{{$page->title}}</a></li>

                @endforeach

            </ul>
          </div>
        </div>

        {{-- <li class="t-h-dropdown">
          <a class="" href="#"><i class="icon-chevron-right"></i>{{__('Pages')}} <i class="icon-chevron-down"></i></a>
          <div class="t-h-dropdown-menu">
              @if ($setting->is_faq == 1)
              <a class="{{ request()->routeIs('front.faq*') ? 'active' : '' }}" href="{{route('front.faq')}}"><i class="icon-chevron-right pr-2"></i>{{__('Faq')}}</a>
              @endif
              @foreach (DB::table('pages')->wherePos(0)->orwhere('pos',2)->get() as $page)
              <a class="{{request()->url() == route('front.page',$page->slug) ? 'active' : ''}} " href="{{route('front.page',$page->slug)}}"><i class="icon-chevron-right pr-2"></i>{{$page->title}}</a>
              @endforeach
          </div>
      </li> --}}

        <div class="col-lg-4">
            <!-- Subscription-->
            <section class="widget">
              <h3 class="widget-title"style="color: #000">{{__('Newsletter')}}</h3>
              <form class="row subscriber-form" action="{{route('front.subscriber.submit')}}" method="post">
                @csrf
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control" type="email" name="email" placeholder="{{__('Your e-mail')}}">
                    <span class="input-group-addon"><i class="icon-mail"></i></span> </div>
                  <div aria-hidden="true">
                    <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                  </div>

                </div>
                <div class="col-sm-12">
                  <button class="btn btn-primary btn-block mt-2" type="submit">
                      <span>{{__('Subscribe')}}</span>
                  </button>
                </div>
                <div class="col-lg-12">
                    <p class="text-sm opacity-80 pt-2">{{__('Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.')}}</p>
                </div>
              </form>
              <div class="pt-3"><img class="d-block gateway_image" src="{{ $setting->footer_gateway_img ? asset('assets/images/'.$setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png') }}"></div>
            </section>
          </div>
      </div>
      <!-- Copyright-->
      <p class="footer-copyright"> {{$setting->copy_right}}</p>
    </div>
  </footer>