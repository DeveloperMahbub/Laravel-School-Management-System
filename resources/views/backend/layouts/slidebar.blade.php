@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      @if (Auth::user()->role=='Admin')
        <li class="nav-item {{ ($prefix == '/users')? 'menu-open': '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Manage User
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('users.view') }}" class="nav-link {{ ($route == 'users.view')? 'active': '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>View User</p>
              </a>
            </li>
          </ul>
        </li>
      @endif
        

      <li class="nav-item {{ ($prefix == '/profiles')? 'menu-open': '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-user-circle"></i>
          <p>
            Manage Profile
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('profiles.view') }}" class="nav-link {{ ($route == 'profiles.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Your Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('profiles.password.view') }}" class="nav-link {{ ($route == 'profiles.password.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Change Password</p>
            </a>
          </li>
        </ul>
      </li>

      
      <li class="nav-item {{ ($prefix == '/setups')? 'menu-open': '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-user-cog"></i>
          <p>
            Manage Setup
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('setups.student.class.view') }}" class="nav-link {{ ($route == 'setups.student.class.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Student Class</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setups.student.year.view') }}" class="nav-link {{ ($route == 'setups.student.year.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Student Year</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setups.student.group.view') }}" class="nav-link {{ ($route == 'setups.student.group.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Student Group</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setups.student.shift.view') }}" class="nav-link {{ ($route == 'setups.student.shift.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Student Shift</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setups.fee.category.view') }}" class="nav-link {{ ($route == 'setups.fee.category.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Fee Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setups.fee.amount.view') }}" class="nav-link {{ ($route == 'setups.fee.amount.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Fee Category Amount</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setups.exam.type.view') }}" class="nav-link {{ ($route == 'setups.exam.type.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Exam Type</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setups.subject.view') }}" class="nav-link {{ ($route == 'setups.subject.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Student Subjects</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setups.assign.subject.view') }}" class="nav-link {{ ($route == 'setups.assign.subject.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Assign Subject</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setups.designation.view') }}" class="nav-link {{ ($route == 'setups.designation.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Designation</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item {{ ($prefix == '/students')? 'menu-open': '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-user-plus"></i>
          <p>
            Manage Students
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('students.registration.view') }}" class="nav-link {{ ($route == 'students.registration.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Student Registration</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('students.roll.view') }}" class="nav-link {{ ($route == 'students.roll.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Roll Genarate</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('students.reg.fee.view') }}" class="nav-link {{ ($route == 'students.reg.fee.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Registration Fee</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('students.monthly.fee.view') }}" class="nav-link {{ ($route == 'students.monthly.fee.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Monthly Fee</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('students.exam.fee.view') }}" class="nav-link {{ ($route == 'students.exam.fee.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Exam Fee</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item {{ ($prefix == '/employees')? 'menu-open': '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-user-tie"></i>
          <p>
            Manage Employee
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('employees.reg.view') }}" class="nav-link {{ ($route == 'employees.reg.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Employee Registration</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('employees.salary.view') }}" class="nav-link {{ ($route == 'employees.salary.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Employee Salary</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('employees.leave.view') }}" class="nav-link {{ ($route == 'employees.leave.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Employee Leave</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('employees.attendance.view') }}" class="nav-link {{ ($route == 'employees.attendance.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Employee Attendance</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('employees.monthly.salary.view') }}" class="nav-link {{ ($route == 'employees.monthly.salary.view')? 'active': '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Employ Monthly Salary</p>
            </a>
          </li>
        </ul>
      </li>
      
    </ul>
  </nav>
  <!-- /.sidebar-menu -->