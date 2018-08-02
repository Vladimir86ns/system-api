<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- BEGIN SINGLE INVESTMENT TABLE-->
      <div class="portlet box primary">
        <div class="portlet-title">
          <div class="caption">
            <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Details
            <span class="pull-right">
              <a href="/investor/get-all/{{ strtolower($transformedSingleInvestment['country'])}}">
                <i style="color: white;" class="fa fa-fw fa-times removepanel clickable"></i>
              </a>
            </span>
          </div>
        </div>
        <div class="portlet-body flip-scroll">
          <table class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
              <tr>
                <th>Name</th>
                <th class="numeric">Total Investition</th>
                <th class="numeric">City</th>
                <th class="numeric">Country</th>
                <th class="numeric">Address</th>
                <th class="numeric">Collected To Date</th>
                <th class="numeric">Closed</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>{{ $transformedSingleInvestment['name'] }}</td>
                  <td class="numeric">{{ $transformedSingleInvestment['total_investition'] }}</td>
                  <td class="numeric">{{ $transformedSingleInvestment['city'] }}</td>
                  <td class="numeric">{{ $transformedSingleInvestment['country'] }}</td>
                  <td class="numeric">{{ $transformedSingleInvestment['address'] }}</td>
                  <td class="numeric">{{ $transformedSingleInvestment['collected_to_date'] }}</td>
                  <td class="numeric">{{ $transformedSingleInvestment['closed'] ? 'Yes' : 'No' }}</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- END SINGLE INVESTMENT TABLE-->
    </div>
  </div>
</section>
  @include('investor.form.invest_to_investments')