 <!-- SEE ALL INVESTMENTS -->
 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- BEGIN ALL INVESTMENTS TABLE-->
      <div class="portlet box primary">
        <div class="portlet-title">
          <div class="caption">
            <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
              TOTAL FOR INVESTING: {{$transformedVgSystem['total_investitions']}}
              ; TOTAL COLLECTED TO DATE: {{$transformedVgSystem['collected_to_date']}}
          </div>
        </div>
        <div class="portlet-body flip-scroll">
          <table class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
              <tr>
                <th>Name</th>
                <th class="numeric">Total Investition</th>
                <th class="numeric">Left To Invest</th>
                <th class="numeric">Country</th>
                <th class="numeric">City</th>
                <th class="numeric">Address</th>
                <th class="numeric">Collected To Date</th>
                <th class="numeric">Closed</th>
                <th class="numeric">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transformedAllInvestments['data'] as $investment)
                @if(!$investment['closed'])
                <tr>
                  <td>{{ $investment['name'] }}</td>
                  <td class="numeric">{{ $investment['total_investition'] }}</td>
                  <td class="numeric">{{ $investment['left_to_invest'] }}</td>
                  <td class="numeric">{{ $investment['country'] }}</td>
                  <td class="numeric">{{ $investment['city'] }}</td>
                  <td class="numeric">{{ $investment['address'] }}</td>
                  <td class="numeric">{{ $investment['collected_to_date'] }}</td>
                  <td class="numeric">{{ $investment['closed'] ? 'Yes' : 'No' }}</td>
                  <td>
                    <a href="/investor/{{$investment['country']}}/get-all-and-selected/{{ $investment['id'] }}">
                      <i class="fa fa-fw fa-sign-in"></i>
                    </a>
                  </td>
                </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- END ALL INVESTMENTS TABLE-->
    </div>
  </div>
</section>