@extends('admin_master')

@section('title','List of Works')
<style type="text/css">
    .table_container
    {
        width: 100%;
        display: inline-block;
        overflow: auto;
        max-height: 400px;
    }
</style>
@section('content')
    {{--@if(session()->has('message'))--}}
    {{--<div class="alert alert-success">--}}
    {{--{{ session()->get('message') }}--}}
    {{--</div>--}}
    {{--@endif--}}
    {{--@if($errors->any())--}}
    {{--<div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>--}}
    {{--@endif--}}


    {{--@php--}}
    {{--$data = DB::selectOne("SELECT * FROM `datasample` WHERE ID = 1");--}}
    {{--@endphp--}}
    {{--<img src="data:image/png;base64,{{ chunk_split(base64_encode($data->IMG)) }}" height="100" width="100">--}}

<script type="text/javascript">
    $(document).ready(function () {
        $("#btnExport").click(function (e) {
            window.open('data:application/vnd.ms-excel,' + $('#row_data').html());
            e.preventDefault();
        });
    });

    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
        }
    })()
</script>
    <div class="row box_containner">
        {{--<div class="col-sm-12 col-md-12 col-xs-12">--}}
            {{--<div class="dash_boxcontainner white_boxlist">--}}
                {{--<div class="upper_basic_heading"><span class="white_dash_head_txt">--}}
                         List of Works
                        {{--<button class="btn btn-default pull-right btn-sm" onclick="exporttoexcel();"><i--}}
                        {{--class="mdi mdi-download"></i> Download Excel</button>--}}
                        {{--<a href="#" class="btn btn-default btnSet add-user pull-right">--}}
                        {{--<span class="fa fa-plus"></span>&nbsp;Create New User</a>--}}  <button type="button" class="btn btn-primary" onclick="tableToExcel('row_data', 'W3C Example Table')"> <i class="mdi mdi-download"></i> Download</button>


                    <div class="table_container">
                    <table id="row_data" class="table table-bordered dataTable table-striped data"
                           cellspacing="0"
                           width="100%">
                        <thead>
                        <tr class="bg-info">
                            <th class="options">S.No.</th>
                            <th>District ID</th>
                            <th>School Code</th>
                            <th>School Name</th>
                            <th>School Address</th>
                            <th>Place</th>
                            <th>Student Number</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Class</th>
                            {{--Student Question Record--}}
                        <th>Q1</th>
                        <th>Q2</th>
                        <th>Q3</th>
                        <th>Q4</th>
                        <th>Q5</th>
                        <th>Q6</th>
                        <th>Q7</th>
                        <th>Q8</th>
                        <th>Q9</th>
                        <th>Q10</th>
                        <th>Q11</th>
                        <th>Q12</th>
                        <th>Q13</th>
                        <th>Q14</th>
                        <th>Q15</th>
                        <th>Q16</th>
                        <th>Q17</th>
                        <th>Q18</th>
                        <th>Q19</th>
                        <th>Q20</th>
                        <th>Q21</th>
                        <th>Q22</th>
                        <th>Q23</th>
                        <th>Q24</th>
                        <th>Q25</th>
                        <th>Q26</th>
                        <th>Q27</th>
                        <th>Q28</th>
                        <th>Q29</th>
                        <th>Q30</th>

                        <th>Q31</th>
                        <th>Q32</th>
                        <th>Q33</th>
                        <th>Q34</th>
                        <th>Q35</th>
                        <th>Q36</th>
                        <th>Q37</th>
                        <th>Q38</th>
                        <th>Q39</th>
                        <th>Q40</th>
                        <th>Q41</th>
                        <th>Q42</th>
                        <th>Q43</th>
                        <th>Q44</th>
                        <th>Q45</th>
                        <th>Q46</th>
                        <th>Q47</th>
                        <th>Q48</th>
                        <th>Q49</th>
                        <th>Q50</th>
                        <th>Q51</th>
                        <th>Q52</th>
                        <th>Q53</th>
                        <th>Q54</th>
                        <th>Q55</th>
                        <th>Q56</th>
                        <th>Q57</th>
                        <th>Q58</th>
                        <th>Q59</th>
                        <th>Q60</th>

                        <th>Q61</th>
                        <th>Q62</th>
                        <th>Q63</th>
                        <th>Q64</th>
                        <th>Q65</th>
                        <th>Q66</th>
                        <th>Q67</th>
                        <th>Q68</th>
                        <th>Q69</th>
                        <th>Q70</th>
                        <th>Q71</th>
                        <th>Q72</th>
                        <th>Q73</th>
                        <th>Q74</th>
                        <th>Q75</th>
                        <th>Q76</th>
                        <th>Q77</th>
                        <th>Q78</th>
                        <th>Q79</th>
                        <th>Q80</th>
                        <th>Q81</th>
                        <th>Q82</th>
                        <th>Q83</th>
                        <th>Q84</th>
                        <th>Q85</th>
                        <th>Q86</th>
                        <th>Q87</th>
                        <th>Q88</th>
                        <th>Q89</th>
                        <th>Q90</th>

                        <th>Q91</th>
                        <th>Q92</th>
                        <th>Q93</th>
                        <th>Q94</th>
                        <th>Q95</th>
                        <th>Q96</th>
                        <th>Q97</th>
                        <th>Q98</th>
                        <th>Q99</th>
                        <th>Q100</th>


                        </tr>
                        </thead>
                        <tbody>
@foreach($result as $index=>$Main_obj)

    <tr>
        <td>{{$index}}</td>
        <td>{{$Main_obj->districtid}}</td>
        <td>{{$Main_obj->school_code}}</td>
        <td>{{$Main_obj->schoolname}}</td>
        <td>{{$Main_obj->schooladdr}}</td>
        <td>{{$Main_obj->place}}</td>
        <td>{{$Main_obj->studentname}}</td>
        <td>{{$Main_obj->fathername}}</td>
        <td>{{$Main_obj->data_id}}</td>
        <td>{{$Main_obj->class_data}}</td>
        {{---------------------------------}}
        <td>{{$Main_obj->f1}}</td>
        <td>{{$Main_obj->f2}}</td>
        <td>{{$Main_obj->f3}}</td>
        <td>{{$Main_obj->f4}}</td>
        <td>{{$Main_obj->f5}}</td>
        <td>{{$Main_obj->f6}}</td>
        <td>{{$Main_obj->f7}}</td>
        <td>{{$Main_obj->f8}}</td>
        <td>{{$Main_obj->f9}}</td>
        <td>{{$Main_obj->f10}}</td>
        <td>{{$Main_obj->f11}}</td>
        <td>{{$Main_obj->f12}}</td>
        <td>{{$Main_obj->f13}}</td>
        <td>{{$Main_obj->f14}}</td>
        <td>{{$Main_obj->f15}}</td>
        <td>{{$Main_obj->f16}}</td>
        <td>{{$Main_obj->f17}}</td>
        <td>{{$Main_obj->f18}}</td>
        <td>{{$Main_obj->f19}}</td>
        <td>{{$Main_obj->f20}}</td>
        <td>{{$Main_obj->f21}}</td>
        <td>{{$Main_obj->f22}}</td>
        <td>{{$Main_obj->f23}}</td>
        <td>{{$Main_obj->f24}}</td>
        <td>{{$Main_obj->f25}}</td>
        <td>{{$Main_obj->f26}}</td>
        <td>{{$Main_obj->f27}}</td>
        <td>{{$Main_obj->f28}}</td>
        <td>{{$Main_obj->f29}}</td>
        <td>{{$Main_obj->f30}}</td>

        <td>{{$Main_obj->f31}}</td>
        <td>{{$Main_obj->f32}}</td>
        <td>{{$Main_obj->f33}}</td>
        <td>{{$Main_obj->f34}}</td>
        <td>{{$Main_obj->f35}}</td>
        <td>{{$Main_obj->f36}}</td>
        <td>{{$Main_obj->f37}}</td>
        <td>{{$Main_obj->f38}}</td>
        <td>{{$Main_obj->f39}}</td>
        <td>{{$Main_obj->f40}}</td>
        <td>{{$Main_obj->f41}}</td>
        <td>{{$Main_obj->f42}}</td>
        <td>{{$Main_obj->f43}}</td>
        <td>{{$Main_obj->f44}}</td>
        <td>{{$Main_obj->f45}}</td>
        <td>{{$Main_obj->f46}}</td>
        <td>{{$Main_obj->f47}}</td>
        <td>{{$Main_obj->f48}}</td>
        <td>{{$Main_obj->f49}}</td>
        <td>{{$Main_obj->f50}}</td>
        <td>{{$Main_obj->f51}}</td>
        <td>{{$Main_obj->f52}}</td>
        <td>{{$Main_obj->f53}}</td>
        <td>{{$Main_obj->f54}}</td>
        <td>{{$Main_obj->f55}}</td>
        <td>{{$Main_obj->f56}}</td>
        <td>{{$Main_obj->f57}}</td>
        <td>{{$Main_obj->f58}}</td>
        <td>{{$Main_obj->f59}}</td>
        <td>{{$Main_obj->f60}}</td>

        <td>{{$Main_obj->f61}}</td>
        <td>{{$Main_obj->f62}}</td>
        <td>{{$Main_obj->f63}}</td>
        <td>{{$Main_obj->f64}}</td>
        <td>{{$Main_obj->f65}}</td>
        <td>{{$Main_obj->f66}}</td>
        <td>{{$Main_obj->f67}}</td>
        <td>{{$Main_obj->f68}}</td>

        <td>{{$Main_obj->f69}}</td>
        <td>{{$Main_obj->f70}}</td>
        <td>{{$Main_obj->f71}}</td>
        <td>{{$Main_obj->f72}}</td>
        <td>{{$Main_obj->f73}}</td>
        <td>{{$Main_obj->f74}}</td>
        <td>{{$Main_obj->f75}}</td>
        <td>{{$Main_obj->f76}}</td>
        <td>{{$Main_obj->f77}}</td>
        <td>{{$Main_obj->f78}}</td>
        <td>{{$Main_obj->f79}}</td>
        <td>{{$Main_obj->f80}}</td>
        <td>{{$Main_obj->f81}}</td>
        <td>{{$Main_obj->f82}}</td>
        <td>{{$Main_obj->f83}}</td>
        <td>{{$Main_obj->f84}}</td>
        <td>{{$Main_obj->f85}}</td>
        <td>{{$Main_obj->f86}}</td>
        <td>{{$Main_obj->f87}}</td>
        <td>{{$Main_obj->f88}}</td>
        <td>{{$Main_obj->f89}}</td>
        <td>{{$Main_obj->f90}}</td>

        <td>{{$Main_obj->f91}}</td>
        <td>{{$Main_obj->f92}}</td>
        <td>{{$Main_obj->f93}}</td>
        <td>{{$Main_obj->f94}}</td>
        <td>{{$Main_obj->f95}}</td>
        <td>{{$Main_obj->f96}}</td>
        <td>{{$Main_obj->f97}}</td>
        <td>{{$Main_obj->f98}}</td>
        <td>{{$Main_obj->f99}}</td>
        <td>{{$Main_obj->f100}}</td>
        
        
    {{--@if(isset($details))--}}
            {{--<td>{{$Main_obj->f1}}</td>--}}
            {{--<td>{{$Main_obj->f2}}</td>--}}
            {{--<td>{{$Main_obj->f3}}</td>--}}
            {{--<td>{{$Main_obj->f4}}</td>--}}
            {{--<td>{{$Main_obj->f5}}</td>--}}
            {{--<td>{{$Main_obj->f6}}</td>--}}
            {{--<td>{{$Main_obj->f7}}</td>--}}
            {{--<td>{{$Main_obj->f8}}</td>--}}
            {{--<td>{{$Main_obj->f9}}</td>--}}
            {{--<td>{{$Main_obj->f10}}</td>--}}
            {{--<td>{{$Main_obj->f11}}</td>--}}
            {{--<td>{{$Main_obj->f12}}</td>--}}
            {{--<td>{{$Main_obj->f13}}</td>--}}
            {{--<td>{{$Main_obj->f14}}</td>--}}
            {{--<td>{{$Main_obj->f15}}</td>--}}
            {{--<td>{{$Main_obj->f16}}</td>--}}
            {{--<td>{{$Main_obj->f17}}</td>--}}
            {{--<td>{{$Main_obj->f18}}</td>--}}
            {{--<td>{{$Main_obj->f19}}</td>--}}
            {{--<td>{{$Main_obj->f20}}</td>--}}
            {{--<td>{{$Main_obj->f21}}</td>--}}
            {{--<td>{{$Main_obj->f22}}</td>--}}
            {{--<td>{{$Main_obj->f23}}</td>--}}
            {{--<td>{{$Main_obj->f24}}</td>--}}
            {{--<td>{{$Main_obj->f25}}</td>--}}
            {{--<td>{{$Main_obj->f26}}</td>--}}
            {{--<td>{{$Main_obj->f27}}</td>--}}
            {{--<td>{{$Main_obj->f28}}</td>--}}
            {{--<td>{{$Main_obj->f29}}</td>--}}
            {{--<td>{{$Main_obj->f30}}</td>--}}

            {{--<td>{{$Main_obj->f31}}</td>--}}
            {{--<td>{{$Main_obj->f32}}</td>--}}
            {{--<td>{{$Main_obj->f33}}</td>--}}
            {{--<td>{{$Main_obj->f34}}</td>--}}
            {{--<td>{{$Main_obj->f35}}</td>--}}
            {{--<td>{{$Main_obj->f36}}</td>--}}
            {{--<td>{{$Main_obj->f37}}</td>--}}
            {{--<td>{{$Main_obj->f38}}</td>--}}
            {{--<td>{{$Main_obj->f39}}</td>--}}
            {{--<td>{{$Main_obj->f40}}</td>--}}
            {{--<td>{{$Main_obj->f41}}</td>--}}
            {{--<td>{{$Main_obj->f42}}</td>--}}
            {{--<td>{{$Main_obj->f43}}</td>--}}
            {{--<td>{{$Main_obj->f44}}</td>--}}
            {{--<td>{{$Main_obj->f45}}</td>--}}
            {{--<td>{{$Main_obj->f46}}</td>--}}
            {{--<td>{{$Main_obj->f47}}</td>--}}
            {{--<td>{{$Main_obj->f48}}</td>--}}
            {{--<td>{{$Main_obj->f49}}</td>--}}
            {{--<td>{{$Main_obj->f50}}</td>--}}
            {{--<td>{{$Main_obj->f51}}</td>--}}
            {{--<td>{{$Main_obj->f52}}</td>--}}
            {{--<td>{{$Main_obj->f53}}</td>--}}
            {{--<td>{{$Main_obj->f54}}</td>--}}
            {{--<td>{{$Main_obj->f55}}</td>--}}
            {{--<td>{{$Main_obj->f56}}</td>--}}
            {{--<td>{{$Main_obj->f57}}</td>--}}
            {{--<td>{{$Main_obj->f58}}</td>--}}
            {{--<td>{{$Main_obj->f59}}</td>--}}
            {{--<td>{{$Main_obj->f60}}</td>--}}

            {{--<td>{{$Main_obj->f61}}</td>--}}
            {{--<td>{{$Main_obj->f62}}</td>--}}
            {{--<td>{{$Main_obj->f63}}</td>--}}
            {{--<td>{{$Main_obj->f64}}</td>--}}
            {{--<td>{{$Main_obj->f65}}</td>--}}
            {{--<td>{{$Main_obj->f66}}</td>--}}
            {{--<td>{{$Main_obj->f67}}</td>--}}
            {{--<td>{{$Main_obj->f68}}</td>--}}

            {{--<td>{{$Main_obj->f69}}</td>--}}
            {{--<td>{{$Main_obj->f70}}</td>--}}
            {{--<td>{{$Main_obj->f71}}</td>--}}
            {{--<td>{{$Main_obj->f72}}</td>--}}
            {{--<td>{{$Main_obj->f73}}</td>--}}
            {{--<td>{{$Main_obj->f74}}</td>--}}
            {{--<td>{{$Main_obj->f75}}</td>--}}
            {{--<td>{{$Main_obj->f76}}</td>--}}
            {{--<td>{{$Main_obj->f77}}</td>--}}
            {{--<td>{{$Main_obj->f78}}</td>--}}
            {{--<td>{{$Main_obj->f79}}</td>--}}
            {{--<td>{{$Main_obj->f80}}</td>--}}
            {{--<td>{{$Main_obj->f81}}</td>--}}
            {{--<td>{{$Main_obj->f82}}</td>--}}
            {{--<td>{{$Main_obj->f83}}</td>--}}
            {{--<td>{{$Main_obj->f84}}</td>--}}
            {{--<td>{{$Main_obj->f85}}</td>--}}
            {{--<td>{{$Main_obj->f86}}</td>--}}
            {{--<td>{{$Main_obj->f87}}</td>--}}
            {{--<td>{{$Main_obj->f88}}</td>--}}
            {{--<td>{{$Main_obj->f89}}</td>--}}
            {{--<td>{{$Main_obj->f90}}</td>--}}

            {{--<td>{{$Main_obj->f91}}</td>--}}
            {{--<td>{{$Main_obj->f92}}</td>--}}
            {{--<td>{{$Main_obj->f93}}</td>--}}
            {{--<td>{{$Main_obj->f94}}</td>--}}
            {{--<td>{{$Main_obj->f95}}</td>--}}
            {{--<td>{{$Main_obj->f96}}</td>--}}
            {{--<td>{{$Main_obj->f97}}</td>--}}
            {{--<td>{{$Main_obj->f98}}</td>--}}
            {{--<td>{{$Main_obj->f99}}</td>--}}
            {{--<td>{{$Main_obj->f100}}</td>--}}
            {{--<td>{{$Main_obj->FILENM}}</td>--}}


        {{--@endif--}}

    </tr>
@endforeach
                        </tbody>
                    </table>
                    </div>

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <script>

        function view_work(dis) {
            $('#myModal').modal('show');
            $('#modal_title').html('View Work');
            $('#mybody').html('<img height="50px" class="center-block" src="{{url('assets/images/loading.gif')}}"/>');
            var id = $(dis).attr('id');
            var editurl = '{{ url('view_work_done') }}';
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: {work_id: id},
                success: function (data) {
                    $('#mybody').html(data);
                },
                error: function (xhr, status, error) {
                    $('#mybody').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        }


    </script>
@stop
