
<div class="container-logo">
    <img src="{{ 'school' ? route('school.logo', ['filename'=>App\School::find(1)->logo]) : ''}}" class="logo"  />
</div>
