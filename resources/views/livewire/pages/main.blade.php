<div>  
    @if ($currentPage === 'Admin.admin-leave-requests-component')  
        @livewire('Admin.admin-leave-requests-component')  
    @elseif ($currentPage === 'employee-selection')  
        @livewire('employee-selection')  
        @elseif ($currentPage === 'leave-request-component')  
        @livewire('leave-request-component')  
    @endif   
</div>