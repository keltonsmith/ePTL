<table class="table table-bordered table-striped display dataTable">
  <thead>
    <tr>
      <!-- <th>SamAccountName</th>
      <th>GivenName</th> -->
      <th>CN</th>
      <th>Email</th>
      <th>Department</th>
      <th>Description</th>
<!--       <th>HomeDirectory</th>
      <th>PhysicalDeliveryOffice</th> -->
      <th>Select</th>
    </tr>
  </thead>
  <tbody>
    @if (count($data) == 0)
    <tr>
      <td colspan="4">No search result</td>
    </tr>
    @else
      @foreach ($data as $row)
      <tr>
<!--         <td class="lf-samaccountname">{{ $row['samaccountname']}}</td>
        <td class="lf-givenname">{{ $row['givenname']}}</td> -->
        <td class="lf-cn">{{ $row['cn']}}</td>
        <td class="lf-email">{{ $row['mail']}}</td>
        {{--<td class="lf-phonenumber">{{ $row['telephonenumber']}}</td>--}}
        {{--<td class="lf-pwd">{{ $row['pwdlastset']}}</td>--}}
        <td class="lf-homedirectory">{{ $row['department']}}</td>
        <td class="lf-description">{{ $row['description']}}</td>
<!--        <td class="lf-pysicdelioffice">{{ $row['physicaldeliveryofficename']}}</td> -->
        <td class="lf-select-button"> <button type="button" class="btn btn-success ladda-button" data-style="zoom-in">Select</button>
      </tr>
      @endforeach
    @endif
  </tbody>
</table>