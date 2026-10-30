<footer class="main-footer">
    <div class="gt-pfooter">
        <p>&copy; {{ date('Y') }} <a href="{{ URL::to('/') }}">Grill and Thrill</a>. All rights reserved.</p>

        <nav class="gt-pfooter__links" aria-label="Footer">
            <a href="tel:02085514329"><i class="fa fa-phone" aria-hidden="true"></i> 020 8551 4329</a>
            <a href="{{ asset('Privacy policy.pdf') }}" target="_blank" rel="noopener">Privacy Policy</a>
            <a href="{{ asset('Website terms and conditions.pdf') }}" target="_blank" rel="noopener">Terms and Conditions</a>
        </nav>
    </div>
</footer>

<!-- Control Sidebar (kept empty so AdminLTE scripts don't break; hidden by CSS) -->
<aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs"></ul>
    <div class="tab-content">
        <div class="tab-pane" id="control-sidebar-home-tab"></div>
        <div class="tab-pane" id="control-sidebar-settings-tab"></div>
    </div>
</aside>
<div class="control-sidebar-bg"></div>