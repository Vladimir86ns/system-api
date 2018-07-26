<div class="row">
  <div class="col-md-12">
    <!-- BEGIN SINGLE INVESTMENT TABLE-->
    <div class="portlet box primary">
      <div class="portlet-title">
        <div class="caption">
          <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Details before accept
          <span class="pull-right">
            <a href="/investments-admin/all-investments">
              <i style="color: white;" class="fa fa-fw fa-times removepanel clickable"></i>
            </a>
          </span>
        </div>
      </div>
      <div class="portlet-body flip-scroll">
        <table class="table table-bordered table-striped table-condensed flip-content">
          <thead class="flip-content">
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th class="numeric">Total Investition</th>
              <th class="numeric">City</th>
              <th class="numeric">Country</th>
              <th class="numeric">Address</th>
              <th class="numeric">Collected To Date</th>
              <th class="numeric">Closed</th>
              <th class="numeric">Status</th>
              <th class="numeric">Action</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td>{{ $transformedInvestment['id'] }}</td>
                <td>{{ $transformedInvestment['name'] }}</td>
                <td class="numeric">{{ $transformedInvestment['total_investition'] }}</td>
                <td class="numeric">{{ $transformedInvestment['city'] }}</td>
                <td class="numeric">{{ $transformedInvestment['country'] }}</td>
                <td class="numeric">{{ $transformedInvestment['address'] }}</td>
                <td class="numeric">{{ $transformedInvestment['collected_to_date'] }}</td>
                <td class="numeric">{{ $transformedInvestment['closed'] ? 'Yes' : 'No' }}</td>
                <td>
                  @if ($transformedInvestment['status'] === 'PENDING')
                    <span class="label label-sm label-info">{{ $transformedInvestment['status'] }}</span>
                  @elseif  ($transformedInvestment['status'] === 'APPROVED')
                    <span class="label label-sm label-success">{{ $transformedInvestment['status'] }}</span>
                  @elseif  ($transformedInvestment['status'] === 'REJECTED')
                    <span class="label label-sm label-danger">{{ $transformedInvestment['status'] }}</span>
                  @endif
                </td>
                <td>
                  @if ($transformedInvestment['status'] != 'REJECTED')
                  <a href="/investments-admin/rejected-or-delete-investment/{{ $transformedInvestment['id'] }}">
                    <i class="fa fa-fw fa-times"></i>
                  </a>
                  @endif
                  @if ($transformedInvestment['status'] === 'PENDING' || $transformedInvestment['status'] === 'REJECTED')
                    <a href="/investments-admin/approve-or-un-approve-investment/{{ $transformedInvestment['id'] }}">
                      <i class="fa fa-fw fa-thumbs-o-up"></i>
                    </a>
                  @elseif  ($transformedInvestment['status'] === 'APPROVED')
                    <a href="/investments-admin/approve-or-un-approve-investment/{{ $transformedInvestment['id'] }}">
                      <i class="fa fa-fw fa-thumbs-o-down"></i>
                    </a>
                  @endif
                </td>
              </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- END SINGLE INVESTMENT TABLE-->
  </div>