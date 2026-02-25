@extends('layouts.public')

@section('content')
<div class="container">
    <div class="row">

        {{-- Attendance Card --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Attendance
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Select Week Start Date</label>
                            <input type="date" id="week_start" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>&nbsp;</label>
                            <button id="loadWeek" class="btn btn-dark w-100">Load Week</button>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('attendance.save') }}">
                        @csrf

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="attendanceBody">
                            </tbody>
                        </table>

                        <button class="btn btn-success" type="submit">Save Attendance</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.getElementById('loadWeek').addEventListener('click', function () {
    const week_start = document.getElementById('week_start').value;

    fetch("{{ route('attendance.loadWeek') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ week_start })
    })
    .then(res => res.json())
    .then(data => {
        let html = '';
        data.forEach(item => {
            html += `
                <tr>
                    <td>${item.day}</td>
                    <td>${item.date}</td>
                    <td>
                        <select name="attendance[${item.date}][status]" class="form-control">
                            <option value="Present" ${item.status == 'Present' ? 'selected' : ''}>Present</option>
                            <option value="Absent" ${item.status == 'Absent' ? 'selected' : ''}>Absent</option>
                        </select>
                        <input type="hidden" name="attendance[${item.date}][date]" value="${item.date}">
                    </td>
                </tr>
            `;
        });

        document.getElementById('attendanceBody').innerHTML = html;
    });
});
</script>
@endsection
