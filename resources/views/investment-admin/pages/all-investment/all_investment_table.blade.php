
<div class="row">
  <div class="col-md-12">
    <div class="portlet box primary">
      <div class="portlet-title">
        <div class="caption">
          <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Investments
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
            @foreach ($allInvestments['data'] as $investment)
              <tr>
                <td>{{ $investment['id'] }}</td>
                <td>{{ $investment['name'] }}</td>
                <td class="numeric">{{ $investment['total_investition'] }}</td>
                <td class="numeric">{{ $investment['city'] }}</td>
                <td class="numeric">{{ $investment['country'] }}</td>
                <td class="numeric">{{ $investment['address'] }}</td>
                <td class="numeric">{{ $investment['collected_to_date'] }}</td>
                <td class="numeric">{{ $investment['closed'] ? 'Yes' : 'No' }}</td>
                <td>
                  @if ($investment['status'] === 'PENDING')
                    <span class="label label-sm label-info">{{ $investment['status'] }}</span>
                  @elseif  ($investment['status'] === 'APPROVED')
                    <span class="label label-sm label-success">{{ $investment['status'] }}</span>
                  @elseif  ($investment['status'] === 'REJECTED')
                    <span class="label label-sm label-danger">{{ $investment['status'] }}</span>
                  @endif
                </td>
                <td>
                  @if(!$investment['on_production'])
                    <a href="/investment-admin/edit/{{ $investment['id'] }}">
                      <i class="fa fa-fw fa-pencil"></i>
                    </a>
                    <a href="/investment-admin/detail/{{ $investment['id'] }}">
                      <i class="fa fa-fw fa-search"></i>
                    </a>
                    @if ($investment['status'] === 'APPROVED')
                      <a href="/investment-admin/before-confirm-investment/{{ $investment['id'] }}">
                        <i class="fa fa-fw fa-hand-o-right"></i>
                      </a>
                    @endif
                    @if ($investment['status'] === 'REJECTED')
                      <a href="/investment-admin/rejected-or-delete/{{ $investment['id'] }}"
                        onclick="return confirm('This will delete the investment. Are you sure you want to proceed?')">
                        <i class="fa fa-fw fa-trash-o"></i>
                      </a>
                    @endif
                  @else
                    <span class="label label-sm label-success">PRODUCTION</span>
                  @endIf
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>