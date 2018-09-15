 <!-- SEE ALL INVESTMENTS -->
 <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- BEGIN ALL INVESTMENTS TABLE-->
        <div class="portlet box primary">
          <div class="portlet-title">
            <div class="caption">
              <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Investments
            </div>
          </div>
          <div class="portlet-body flip-scroll">
            <table class="table table-bordered table-striped table-condensed flip-content">
              <thead class="flip-content">
                <tr>
                  <th>Name</th>
                  <th class="numeric">You Invested</th>
                  <th class="numeric">Percentage Invested In Single Investion</th>
                  <th class="numeric">Left For Investing</th>
                  <th class="numeric">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transformedUserInvestment['data'] as $investment)
                  <tr>
                    <td>{{ $investment['name'] }}</td>
                    <td class="numeric">{{ $investment['total_investment'] }}</td>
                    <td class="numeric">{{ $investment['percentage'] }}</td>
                    <td class="numeric">{{ $investment['left_to_invest'] }}</td>
                    <td>
                      <a href="#">
                        <i class="fa fa-fw fa-search"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- END ALL INVESTMENTS TABLE-->
      </div>
    </div>
  </section>