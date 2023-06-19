<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{route('admin.dashboard')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.dash.main">لوحة التحكم</span><span
                        class="badge badge badge-info badge-pill float-right mr-2">3</span></a>
                <ul class="menu-content">
                    <li class=" {{ request()->is('admin') ? 'active' : '' }}"><a class="menu-item"
                                                                                 href="{{route('admin.dashboard')}}"
                                                                                 data-i18n="nav.dash.ecommerce">الصفحة
                            الرئيسية</a>
                    </li>
                </ul>
            </li>

            @if(auth()->user()->can('read_users') || auth()->user()->can('read_employees'))
                <li class="nav-item "><a href="#"><i class="la la-user"></i><span class="menu-title"
                                                                                  data-i18n="nav.users.main">المستخدمين</span></a>
                    <ul class="menu-content ">
                        @can('read_users')
                            <li class=" {{ request()->is('admin/users') ? 'active' : '' }}"><a class="menu-item  "
                                                                                               href="{{route('users.index')}}"
                                                                                               data-i18n="nav.users.user_profile">المشتركين</a>
                            </li>
                        @endcan

                        @can('read_employees')
                            <li class="{{ request()->is('admin/employees') ? 'active' : '' }}"><a class="menu-item "
                                                                                                  href="{{route('employees.index')}}"
                                                                                                  data-i18n="nav.users.user_cards">الموظفين</a>
                            </li>
                        @endcan


                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('read_services'))
                <li class=" nav-item"><a href="#"><i class="la la-area-chart"></i><span class="menu-title"
                                                                                     data-i18n="nav.navbars.main">الرسائل</span></a>
                    <ul class="menu-content">
                        @can('read_services')
                            <li class="{{ request()->is('admin/MessageSms') ? 'active' : '' }}"><a class="menu-item"
                                                                                                 href="{{route('MessageSms.index')}}"
                                                                                                 data-i18n="nav.navbars.nav_light">الرسائل</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
            @if(auth()->user()->can('read_subscriptions') || auth()->user()->can('read_user_subscriptions') )
                <li class=" nav-item"><a href="#"><i class="la la-user-times"></i><span class="menu-title"
                                                                                        data-i18n="nav.changelog.main">الحجوزات</span></a>
                    <ul class="menu-content">
                        @can('read_subscriptions')
                            <li class="{{ request()->is('admin/user_reservations') ? 'active' : '' }}"><a class="menu-item "
                                                                                                      href="{{route('user_reservations.index')}}"
                                                                                                      data-i18n="nav.changelog.main">حجوزات المستخدمين</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endif

            <li class=" nav-item"><a href="#"><i class="la la-expand"></i><span class="menu-title"
                                                                                data-i18n="nav.menu_levels.main">المصروفات</span></a>
                <ul class="menu-content">

                    <li class="{{ request()->is('admin/expenses') ? 'active' : '' }}"><a
                            class="menu-item "
                            href="{{route('expenses.index')}}"
                            data-i18n="nav.menu_levels.second_level">المصروفات</a>
                    </li>


                </ul>
            </li>


            @if(auth()->user()->can('read_catch_receipts') || auth()->user()->can('read_receipts') )
                <li class=" nav-item"><a href="#"><i class="la la-bank"></i><span class="menu-title"
                                                                                  data-i18n="nav.menu_levels.main">سندات القبض والصرف</span></a>
                    <ul class="menu-content">
                        @can('read_catch_receipts')
                            <li class="{{ request()->is('admin/catch_receipts') ? 'active' : '' }}"><a
                                    class="menu-item "
                                    href="{{route('catch_receipts.index')}}"
                                    data-i18n="nav.menu_levels.second_level">سندات
                                    القبض</a>
                            </li>
                        @endcan
                        @can('read_receipts')
                            <li class="{{ request()->is('admin/receipts') ? 'active' : '' }}"><a class="menu-item "
                                                                                                 href="{{route('receipts.index')}}"
                                                                                                 data-i18n="nav.menu_levels.second_level">سندات
                                    الصرف</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif




            @if(auth()->user()->can('read_report_receipts') || auth()->user()->can('read_report_catch_receipts')  || auth()->user()->can('read_report_expenses')|| auth()->user()->can('read_report_subscriptions'))
                <li class=" nav-item"><a href="#"><i class="la la-paperclip"></i><span class="menu-title"
                                                                                       data-i18n="nav.menu_levels.main">التقارير</span></a>
                    <ul class="menu-content">
                        @can('read_report_expenses')
                            <li class="{{ request()->is('admin/ExpensesReport') ? 'active' : '' }}">

                                <a
                                    class="menu-item "
                                    href="{{route('admin.expenses_report')}}"
                                    data-i18n="nav.menu_levels.second_level">
                                    تقارير المصروفات
                                </a>
                            </li>
                        @endcan

                        @can('read_report_catch_receipts')
                            <li class="{{ request()->is('admin/CatchReceiptReport') ? 'active' : '' }}">
                                <a
                                    class="menu-item "
                                    href="{{route('admin.catch_receipt_report')}}"
                                    data-i18n="nav.menu_levels.second_level">
                                    تقارير سندات القبض
                                </a>
                            </li>
                        @endcan
                        @can('read_report_receipts')
                            <li class="{{ request()->is('admin/ReceiptReport') ? 'active' : '' }}">
                                <a
                                    class="menu-item "
                                    href="{{route('admin.receipt_report')}}"
                                    data-i18n="nav.menu_levels.second_level">
                                    تقارير سندات الصرف
                                </a>
                            </li>
                        @endcan

                        @can('read_report_subscriptions')
                            <li class="{{ request()->is('admin/SubscriptionsReport') ? 'active' : '' }}">
                                <a
                                    class="menu-item "
                                    href="{{route('admin.subscriptions_report')}}"
                                    data-i18n="nav.menu_levels.second_level">
                                    تقارير الاشتراكات
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endif
            @can('read_settings')
                <li class=" nav-item"><a href="#"><i class="la la-gears"></i><span class="menu-title"
                                                                                   data-i18n="nav.menu_levels.main">الإعدادت</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('admin/settings') ? 'active' : '' }}">
                            <a class="menu-item " href="{{route('settings.index')}}" data-i18n="nav.menu_levels.second_level">الإعدادت
                                العامة</a>
                        </li>
                        <li class="{{ request()->is('admin/Intervals') ? 'active' : '' }}">

                        <a class="menu-item " href="{{route('Intervals.index')}}" data-i18n="nav.menu_levels.second_level">الفترات الزمنية</a>
                        </li>
                    </ul>
                </li>
            @endcan

            @if(auth()->user()->can('read_admins') || auth()->user()->can('read_roles'))
                <li class=" nav-item"><a href="#"><i class="la la-lock"></i><span class="menu-title"
                                                                                  data-i18n="nav.menu_levels.main">المسؤولين والصلاحيات</span></a>
                    <ul class="menu-content">
                        @can('read_admins')
                            <li class="{{ request()->is('admin/admins') ? 'active' : '' }}"><a class="menu-item "
                                                                                               href="{{route('admins.index')}}"
                                                                                               data-i18n="nav.menu_levels.second_level">المسؤولين</a>
                            </li>
                        @endcan
                        @can('read_roles')
                            <li class="{{ request()->is('admin/roles') ? 'active' : '' }}"><a class="menu-item "
                                                                                              href="{{route('roles.index')}}"
                                                                                              data-i18n="nav.menu_levels.second_level">الصلاحيات</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif


            <li class=" nav-item"><a href="#"><i class="la la-archive"></i><span class="menu-title"
                                                                                 data-i18n="nav.menu_levels.main">الأرشيف</span></a>
                <ul class="menu-content">

                    <li class="{{ request()->is('admin/getEmployeeArchive') ? 'active' : '' }}"><a class="menu-item "
                                                                                                   href="{{route('admin.get_employeesArchive')}}"
                                                                                                   data-i18n="nav.menu_levels.second_level">الموظفين</a>
                    </li>


                    <li class="{{ request()->is('admin/getUserArchive') ? 'active' : '' }}"><a class="menu-item "
                                                                                               href="{{route('admin.get_usersArchive')}}"
                                                                                               data-i18n="nav.menu_levels.second_level">المستخدمين</a>
                    </li>
                    <li class="{{ request()->is('admin/getServicesArchive') ? 'active' : '' }}"><a class="menu-item "
                                                                                                   href="{{route('admin.get_servicesArchive')}}"
                                                                                                   data-i18n="nav.menu_levels.second_level">الخدمات</a>
                    </li>
                    <li class="{{ request()->is('admin/getUserSubscriptions') ? 'active' : '' }}"><a class="menu-item "
                                                                                                     href="{{route('admin.get_UserSubscriptionArchive')}}"
                                                                                                     data-i18n="nav.menu_levels.second_level">الاشتراكات</a>
                    </li>

                    <li class="{{ request()->is('admin/getCatchReceiptsArchive') ? 'active' : '' }}"><a
                            class="menu-item "
                            href="{{route('admin.getCatchReceiptsArchive')}}"
                            data-i18n="nav.menu_levels.second_level">سندات القبض</a>
                    </li>
                    <li class="{{ request()->is('admin/getReceiptsArchive') ? 'active' : '' }}"><a class="menu-item "
                                                                                                   href="{{route('admin.getReceiptsArchive')}}"
                                                                                                   data-i18n="nav.menu_levels.second_level">سندات
                            الصرف</a>
                    </li>


                </ul>
            </li>


        </ul>
    </div>
</div>
