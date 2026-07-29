<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            Business Details

        </h5>

    </div>

    <div class="card-body">

        <table class="table mb-0">

            <tr>

                <th width="35%">Employees</th>

                <td>{{ $company->staff_count ?: 'Not provided' }}</td>

            </tr>

            <tr>

                <th>Years in Business</th>

                <td>{{ $company->years_in_business ?: 'Not provided' }}</td>

            </tr>

            <tr>

                <th>Annual Turnover</th>

                <td>{{ $company->annual_turnover ?? 'Not provided' }}</td>

            </tr>

            <tr>

                <th>Country</th>

                <td>{{ $company->country->name ?? 'Not provided' }}</td>

            </tr>

            <tr>

                <th>State</th>

                <td>{{ $company->state->name ?? 'Not provided' }}</td>

            </tr>

            <tr>

                <th>City</th>

                <td>{{ $company->city->name ?? 'Not provided' }}</td>

            </tr>

            <tr>

                <th>Address</th>

                <td>{{ $company->address ?? 'Not provided' }}</td>

            </tr>

        </table>

    </div>

</div>
