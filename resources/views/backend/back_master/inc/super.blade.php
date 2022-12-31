<ul class="nav">

    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fas fa-home"></i>
            <p>{{ __('Dashboard') }}</p>
        </a>
    </li>

    <li class="nav-item">
        <a data-toggle="collapse" href="#category">
            <i class="fas fa-list-alt"></i>
            <p>{{ __('Manage Categories') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="category">
            <ul class="nav nav-collapse">  
                <li>
                    <a class="sub-link" href="{{ route('admin.category.index') }}">
                        <span class="sub-item">{{ __('Categories') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.subcategory.index') }}">
                        <span class="sub-item">{{ __('Sub categories') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.childcat.index') }}">
                        <span class="sub-item">{{ __('Child categories') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a data-toggle="collapse" href="#fabricTypes">
            <i class="fas fa-list-alt"></i>
            <p>{{ __('Manage Fabric Types') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="fabricTypes">
            <ul class="nav nav-collapse">  
                <li>
                    <a class="sub-link" href="{{ route('admin.fabric.index') }}">
                        <span class="sub-item">{{ __('Fabric Type') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.fit.index') }}">
                        <span class="sub-item">{{ __('Fabric Fit') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.pattern.index') }}">
                        <span class="sub-item">{{ __('Fabric Pattern') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.sleeve.index') }}">
                        <span class="sub-item">{{ __('Fabric Sleeve') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.occasion.index') }}">
                        <span class="sub-item">{{ __('Fabric Occasion') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.neck.index') }}">
                        <span class="sub-item">{{ __('Fabric Neck') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a data-toggle="collapse" href="#items">
            <i class="fab fa-product-hunt"></i>
            <p>{{ __('Manage Products') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="items">
            <ul class="nav nav-collapse">
                <li>
                    <a class="sub-link" href="{{ route('admin.brand.index') }}">
                        <span class="sub-item">{{ __('Brands') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.color.index') }}">
                        <span class="sub-item">{{ __('Colors') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.size.index') }}">
                        <span class="sub-item">{{ __('Sizes') }}</span>
                    </a>
                </li>
              
                <li>
                    <a class="sub-link" href="{{ route('admin.product.add') }}">
                        <span class="sub-item">{{ __('Add Product') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.product.index') }}">
                        <span class="sub-item">{{ __('All Products') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.product.stock.out') }}">
                        <span class="sub-item">{{ __('Stock Out Products') }}</span>
                    </a>
                </li>
               <li>
                    <a class="sub-link" href="{{ route('admin.campaign.index') }}">
                        <span class="sub-item">{{ __('Campaign Offer') }}</span>
                    </a>
                </li>
                 <li>
                    <a class="sub-link" href="{{ route('admin.bulk.product.index') }}">
                        <span class="sub-item">{{ __('CSV Import & Export') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.review.index') }}">
                      <span class="sub-item">{{ __('Product Reviews') }}</span></a>
                </li> 
            </ul>
        </div>
    </li>



    <li class="nav-item">
        <a  href="{{ route('admin.transaction.index') }}">
            <i class="fas fa-random"></i>
          <p>{{ __('Transactions') }}</p>
        </a>
    </li>

    <li class="nav-item">
        <a data-toggle="collapse" href="#ecommerce">
            <i class="fas fa-newspaper"></i>
            <p>{{ __('Ecommerce') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="ecommerce">
            <ul class="nav nav-collapse">
                <li>
                    <a class="sub-link" href="{{ route('admin.currency.index') }}">
                        <span class="sub-item">{{ __('Currency') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.tax.index') }}">
                        <span class="sub-item">{{ __('Tax') }}</span>
                    </a>
                </li> 
                <li>
                    <a class="sub-link" href="{{ route('admin.state.index') }}">
                        <span class="sub-item">{{ __('State Tax') }}</span>
                    </a>
                </li>
                {{-- <li>
                    <a class="sub-link" href="{{ route('admin.coupon.index') }}">
                      <span class="sub-item">{{ __('Set Coupons') }}</span></a>
                </li> --}}
                <li>
                    <a class="sub-link" href="{{url('admin/coupons') }}">
                      <span class="sub-item">{{ __('Set Coupons') }}</span></a>
                </li>
               <li>
                    <a class="sub-link" href="{{ route('admin.shipping.index') }}">
                        <span class="sub-item">{{ __('Shipping') }}</span>
                    </a>
                </li>
               <li>
                    <a class="sub-link" href="{{ route('admin.setting.payment') }}">
                        <span class="sub-item">{{ __('Payment') }}</span>
                    </a>
                </li> 
            </ul>
        </div>
    </li>


    <li class="nav-item {{ request()->is('orders/*') ? 'submenu' : '' }}">
        <a data-toggle="collapse" href="#order">
            <i class="fab fa-first-order"></i>
            <p>{{ __('Manage Orders') }} </p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="order">
            <ul class="nav nav-collapse">
                <li class="{{!request()->input('type') && request()->is('admin/orders')  ? 'active' : ''}}">
                    <a class="sub-link" href="{{ route('admin.order.index') }}">
                        <span class="sub-item">{{ __('All Orders') }}</span>
                    </a>
                </li>
                <li class="{{request()->input('type') == 'Pending' ? 'active' : ''}}">
                    <a class="sub-link" href="{{ route('admin.order.index').'?type='.'Pending' }}">
                        <span class="sub-item">{{ __('Pending Orders') }}</span>
                    </a>
                </li>
                <li class="{{request()->input('type') == 'In Progress' ? 'active' : ''}}">
                    <a class="sub-link" href="{{ route('admin.order.index').'?type='.'In Progress' }}">
                        <span class="sub-item">{{ __('Progress Orders') }}</span>
                    </a>
                </li>

                <li class="{{request()->input('type') == 'Delivered' ? 'active' : ''}}">
                    <a class="sub-link" href="{{ route('admin.order.index').'?type='.'Delivered' }}">
                        <span class="sub-item">{{ __('Delivered Orders') }}</span>
                    </a>
                </li>
                <li class="{{request()->input('type') == 'Canceled' ? 'active' : ''}}">
                    <a class="sub-link" href="{{ route('admin.order.index').'?type='.'Canceled' }}">
                        <span class="sub-item">{{ __('Canceled Orders') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>



    <li class="nav-item">
        <a data-toggle="collapse" href="#content">
            <i class="fas fa-tasks"></i>
            <p>{{ __('Manage Site') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="content">
            <ul class="nav nav-collapse">
                <li>
                    <a class="sub-link" href="{{ route('admin.setting.system') }}">
                        <span class="sub-item">{{ __('General Settings') }}</span>
                    </a>
                </li>  
                <li>
                    <a  class="sub-link" href="{{ route('admin.slider.index') }}">
                        <span class="sub-item">{{ __('Sliders') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.language.index') }}">
                      <span class="sub-item">{{ __('Language') }}</span></a>
                </li> 
                <li>
                    <a class="sub-link" href="{{ route('admin.service.index') }}">
                        <span class="sub-item">{{ __('Services') }}</span>
                    </a>  
                </li>
               <li>
                    <a class="sub-link" href="{{ route('admin.homePage') }}">
                        <span class="sub-item">{{ __('Home Page') }}</span>
                    </a>
                </li>
               
              <li>
                    <a class="sub-link" href="{{ route('admin.setting.section') }}">
                        <span class="sub-item">{{ __('Visibility') }}</span>
                    </a>
                </li>

              <li>
                    <a class="sub-link" href="{{ route('admin.setting.social') }}">
                        <span class="sub-item">{{ __('Social Login') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.social.index') }}">
                        <span class="sub-item">{{ __('Social Media Index') }}</span>
                    </a>
                </li>
                 <li>
                    <a class="sub-link" href="{{ route('admin.setting.email') }}">
                        <span class="sub-item">{{ __('Email Settings') }}</span>
                    </a>
                </li>
             
              <li>
                    <a class="sub-link" href="{{ route('admin.setting.sms') }}">
                        <span class="sub-item">{{ __('SMS Settings') }}</span>
                    </a>
                </li>
                 <li>
                    <a class="sub-link" href="{{ route('admin.subscribers.announcement') }}">
                      <span class="sub-item">{{ __('Announcement') }}</span></a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.cookie.alert') }}">
                      <span class="sub-item">{{ __('Cookies Alert') }}</span></a>
                </li>

                  <li>
                    <a class="sub-link" href="{{ route('admin.setting.maintainance') }}">
                      <span class="sub-item">{{ __('Maintainance') }}</span></a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.sitemap.index') }}">
                      <span class="sub-item">{{ __('Sitemap') }}</span></a>
                </li>
            </ul>
        </div>
    </li>


    <li class="nav-item">
      <a data-toggle="collapse" href="#faqs">
          <i class="fas fa-question-circle"></i>
          <p>{{ __('Manage Faqs') }}</p>
          <span class="caret"></span>
      </a>
      <div class="collapse" id="faqs">
          <ul class="nav nav-collapse">
              <li>
                  <a class="sub-link" href="{{ route('admin.fcategory.index') }}">
                      <span class="sub-item">{{ __('Categories') }}</span>
                  </a>
              </li>
              <li>
                  <a class="sub-link" href="{{ route('admin.faq.index') }}">
                      <span class="sub-item">{{ __('Faqs') }}</span>
                  </a>
              </li>
          </ul>
      </div>
  </li>



    <li class="nav-item">
        <a data-toggle="collapse" href="#user">
            <i class="far fa-user"></i>
            <p>{{ __('System User') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="user">
            <ul class="nav nav-collapse">
                <li>
                    <a class="sub-link" href="{{ route('admin.role.index') }}">
                        <span class="sub-item">{{ __('Role') }}</span>
                    </a>
                </li>
                <li>
                    <a class="sub-link" href="{{ route('admin.staff.index') }}">
                        <span class="sub-item">{{ __('System User') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
  

    <li class="nav-item">
        <a href="{{ route('admin.page.index') }}">
            <i class="fas fa-book"></i>
            <p>{{ __('Manages Pages') }}</p>
        </a>
    </li>


    <li class="nav-item">
        <a href="{{ route('admin.user.index') }}">
          <i class="fas fa-users"></i>
          <p>{{ __('Customer List') }}</p></a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.subscribers.index') }}">
            <i class="fab fa-telegram-plane"></i>
            <p>{{ __('Subscribers List') }}</p>
        </a>
    </li>


    <li class="nav-item">
        <a href="{{ route('admin.ticket.index') }}">
            <i class="fas fa-comments"></i>
          <p>{{ __('Manages Tickets') }}</p></a>
    </li>



    <li class="nav-item">
        <a data-toggle="collapse" href="#backup">
            <i class="fas fa-hdd"></i>
            <p>{{ __('System Backup') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="backup">
            <ul class="nav nav-collapse">
             <li>
                    <a class="sub-link" href="{{ route('admin.system.backup') }}">
                        <span class="sub-item">{{ __('System Backup') }}</span>
                    </a>
                </li> 
                <li>
                    <a class="sub-link" href="{{ route('admin.database.backup') }}">
                        <span class="sub-item">{{ __('Database Backup') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a href="{{ route('front.cache.clear') }}">
            <i class="fas fa-broom"></i>
            <p>{{ __('Cache Clear') }}</p>
        </a>
    </li>



</ul>
