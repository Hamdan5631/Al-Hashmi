<div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
            class="bx bx-dots-vertical-rounded"></i></button>
    <div class="dropdown-menu dropdown-menu-end m-0" style="">
        <a href="{{route('employees.show',$id)}}" class="dropdown-item">View</a>
        @if($status ==\App\Enums\Users\UserStatusEnum::Active->value)
            <a href="{{route('employees.destroy',$id)}}" class="dropdown-item status-change">Block</a>
        @endif
        @if($status ==\App\Enums\Users\UserStatusEnum::Blocked->value)
            <a href="{{route('employees.destroy',$id)}}" class="dropdown-item status-change">UnBlock</a>

        @endif
    </div>
</div>



