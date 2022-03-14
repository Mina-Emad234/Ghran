@extends('site.index')
@section('title','الانتساب للفريق التطوعي')
@section('content')
    <script src='https://www.google.com/recaptcha/api.js'></script>



    <div class="banner-inner">
        <div class="container">
            <h1 class="pull-right">أعضاء الفريق التطوعي</h1>
            <ul class="breadcrumb pull-left">
                <li><a href="{{route('home')}}">الرئيسية</a></li>
                <li class="active">أعضاء الفريق التطوعي</li>
            </ul>
        </div>
    </div>





    <section class="gray">

        <div class="container" id="resp-height">

            <div class="col-md-8">
                <div class="content">

                    @if(session()->has('team_success'))
                        <div class="alert alert-info">
                            <strong>{{session()->get('team_success')}}</strong>
                        </div>
                    @endif
                    @if(isset($_COOKIE['team_sent']))
                        <div class="alert alert-info">
                            <strong>تم تسجيل طلب الإنضمام من قبل غير مسموح بالتسجيل مرة أخرى  </strong>
                        </div>
                    @endif
                    @if(session()->has('team_error'))
                        <div class="alert alert-danger">
                            <strong>{{session()->get('team_error')}}</strong>
                        </div>
                    @endif

                <form method="post" action="{{route('volunteer.send')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>الاســـم</label>
                        <input name="name" value="{{old('name')}}" type="text" class="form-control" placeholder="ادخل الاســـم">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label>الجنسية</label>
                        <select class="form-control" name="nationality">
                            <option value="" disabled selected>-----</option>
                            <option value="AD" @if(old('nationality') == 'AD') selected @endif>Andorra</option>
                            <option value="AE" @if(old('nationality') == 'AE') selected @endif>United Arab Emirates</option>
                            <option value="AF" @if(old('nationality') == 'AF') selected @endif>Afghanistan</option>
                            <option value="AG" @if(old('nationality') == 'AG') selected @endif>Antigua and Barbuda</option>
                            <option value="AI" @if(old('nationality') == 'AI') selected @endif>Anguilla</option>
                            <option value="AL" @if(old('nationality') == 'AL') selected @endif>Albania</option>
                            <option value="AM" @if(old('nationality') == 'AM') selected @endif>Armenia</option>
                            <option value="AN" @if(old('nationality') == 'AN') selected @endif>Netherlands Antilles</option>
                            <option value="AO" @if(old('nationality') == 'AO') selected @endif>Angola</option>
                            <option value="AQ" @if(old('nationality') == 'AQ') selected @endif>Antarctica</option>
                            <option value="AR" @if(old('nationality') == 'AR') selected @endif>Argentina</option>
                            <option value="AS" @if(old('nationality') == 'AS') selected @endif>American Samoa</option>
                            <option value="AT" @if(old('nationality') == 'AT') selected @endif>Austria</option>
                            <option value="AU" @if(old('nationality') == 'AU') selected @endif>Australia</option>
                            <option value="AW" @if(old('nationality') == 'AW') selected @endif>Aruba</option>
                            <option value="AX" @if(old('nationality') == 'AX') selected @endif>Aland Islands</option>
                            <option value="AZ" @if(old('nationality') == 'AZ') selected @endif>Azerbaijan</option>
                            <option value="BA" @if(old('nationality') == 'BA') selected @endif>Bosnia and Herzegovina</option>
                            <option value="BB" @if(old('nationality') == 'BB') selected @endif>Barbados</option>
                            <option value="BD" @if(old('nationality') == 'BD') selected @endif>Bangladesh</option>
                            <option value="BE" @if(old('nationality') == 'BE') selected @endif>Belgium</option>
                            <option value="BF" @if(old('nationality') == 'BF') selected @endif>Burkina Faso</option>
                            <option value="BG" @if(old('nationality') == 'BG') selected @endif>Bulgaria</option>
                            <option value="BH" @if(old('nationality') == 'BH') selected @endif>Bahrain</option>
                            <option value="BI" @if(old('nationality') == 'BI') selected @endif>Burundi</option>
                            <option value="BJ" @if(old('nationality') == 'BJ') selected @endif>Benin</option>
                            <option value="BL" @if(old('nationality') == 'BL') selected @endif>Saint Barthélemy</option>
                            <option value="BM" @if(old('nationality') == 'BM') selected @endif>Bermuda</option>
                            <option value="BN" @if(old('nationality') == 'BN') selected @endif>Brunei</option>
                            <option value="BO" @if(old('nationality') == 'BO') selected @endif>Bolivia</option>
                            <option value="BR" @if(old('nationality') == 'BR') selected @endif>Brazil</option>
                            <option value="BS" @if(old('nationality') == 'BS') selected @endif>Bahamas</option>
                            <option value="BT" @if(old('nationality') == 'BT') selected @endif>Bhutan</option>
                            <option value="BV" @if(old('nationality') == 'BV') selected @endif>Bouvet Island</option>
                            <option value="BW" @if(old('nationality') == 'BW') selected @endif>Botswana</option>
                            <option value="BY" @if(old('nationality') == 'BY') selected @endif>Belarus</option>
                            <option value="BZ" @if(old('nationality') == 'BZ') selected @endif>Belize</option>
                            <option value="CA" @if(old('nationality') == 'CA') selected @endif>Canada</option>
                            <option value="CC" @if(old('nationality') == 'CC') selected @endif>Cocos (Keeling) Islands</option>
                            <option value="CD" @if(old('nationality') == 'CD') selected @endif>Congo (Kinshasa)</option>
                            <option value="CF" @if(old('nationality') == 'CF') selected @endif>Central African Republic</option>
                            <option value="CG" @if(old('nationality') == 'CG') selected @endif>Congo (Brazzaville)</option>
                            <option value="CH" @if(old('nationality') == 'CH') selected @endif>Switzerland</option>
                            <option value="CI" @if(old('nationality') == 'CI') selected @endif>Ivory Coast</option>
                            <option value="CK" @if(old('nationality') == 'CK') selected @endif>Cook Islands</option>
                            <option value="CL" @if(old('nationality') == 'CL') selected @endif>Chile</option>
                            <option value="CM" @if(old('nationality') == 'CM') selected @endif>Cameroon</option>
                            <option value="CN" @if(old('nationality') == 'CN') selected @endif>China</option>
                            <option value="CO" @if(old('nationality') == 'CO') selected @endif>Colombia</option>
                            <option value="CR" @if(old('nationality') == 'CR') selected @endif>Costa Rica</option>
                            <option value="CU" @if(old('nationality') == 'CU') selected @endif>Cuba</option>
                            <option value="CW" @if(old('nationality') == 'CW') selected @endif>Curaçao</option>
                            <option value="CV" @if(old('nationality') == 'CV') selected @endif>Cape Verde</option>
                            <option value="CX" @if(old('nationality') == 'CX') selected @endif>Christmas Island</option>
                            <option value="CY" @if(old('nationality') == 'CY') selected @endif>Cyprus</option>
                            <option value="CZ" @if(old('nationality') == 'CZ') selected @endif>Czech Republic</option>
                            <option value="DE" @if(old('nationality') == 'DE') selected @endif>Germany</option>
                            <option value="DJ" @if(old('nationality') == 'DJ') selected @endif>Djibouti</option>
                            <option value="DK" @if(old('nationality') == 'DK') selected @endif>Denmark</option>
                            <option value="DM" @if(old('nationality') == 'DM') selected @endif>Dominica</option>
                            <option value="DO" @if(old('nationality') == 'DO') selected @endif>Dominican Republic</option>
                            <option value="DZ" @if(old('nationality') == 'DZ') selected @endif>Algeria</option>
                            <option value="EC" @if(old('nationality') == 'EC') selected @endif>Ecuador</option>
                            <option value="EE" @if(old('nationality') == 'EE') selected @endif>Estonia</option>
                            <option value="EG" @if(old('nationality') == 'EG') selected @endif>Egypt</option>
                            <option value="EH" @if(old('nationality') == 'EH') selected @endif>Western Sahara</option>
                            <option value="ER" @if(old('nationality') == 'ER') selected @endif>Eritrea</option>
                            <option value="ES" @if(old('nationality') == 'ES') selected @endif>Spain</option>
                            <option value="ET" @if(old('nationality') == 'ET') selected @endif>Ethiopia</option>
                            <option value="FI" @if(old('nationality') == 'FI') selected @endif>Finland</option>
                            <option value="FJ" @if(old('nationality') == 'FJ') selected @endif>Fiji</option>
                            <option value="FK" @if(old('nationality') == 'FK') selected @endif>Falkland Islands</option>
                            <option value="FM" @if(old('nationality') == 'FM') selected @endif>Micronesia</option>
                            <option value="FO" @if(old('nationality') == 'FO') selected @endif>Faroe Islands</option>
                            <option value="FR" @if(old('nationality') == 'FR') selected @endif>France</option>
                            <option value="GA" @if(old('nationality') == 'GA') selected @endif>Gabon</option>
                            <option value="GB" @if(old('nationality') == 'GB') selected @endif>United Kingdom</option>
                            <option value="GD" @if(old('nationality') == 'GD') selected @endif>Grenada</option>
                            <option value="GE" @if(old('nationality') == 'GE') selected @endif>Georgia</option>
                            <option value="GF" @if(old('nationality') == 'GF') selected @endif>French Guiana</option>
                            <option value="GG" @if(old('nationality') == 'GG') selected @endif>Guernsey</option>
                            <option value="GH" @if(old('nationality') == 'GH') selected @endif>Ghana</option>
                            <option value="GI" @if(old('nationality') == 'GI') selected @endif>Gibraltar</option>
                            <option value="GL" @if(old('nationality') == 'GL') selected @endif>Greenland</option>
                            <option value="GM" @if(old('nationality') == 'GM') selected @endif>Gambia</option>
                            <option value="GN" @if(old('nationality') == 'GN') selected @endif>Guinea</option>
                            <option value="GP" @if(old('nationality') == 'GP') selected @endif>Guadeloupe</option>
                            <option value="GQ" @if(old('nationality') == 'GQ') selected @endif>Equatorial Guinea</option>
                            <option value="GR" @if(old('nationality') == 'GR') selected @endif>Greece</option>
                            <option value="GS" @if(old('nationality') == 'GS') selected @endif>South Georgia and the South Sandwich Islands</option>
                            <option value="GT" @if(old('nationality') == 'GT') selected @endif>Guatemala</option>
                            <option value="GU" @if(old('nationality') == 'GU') selected @endif>Guam</option>
                            <option value="GW" @if(old('nationality') == 'GW') selected @endif>Guinea-Bissau</option>
                            <option value="GY" @if(old('nationality') == 'GY') selected @endif>Guyana</option>
                            <option value="HK" @if(old('nationality') == 'HK') selected @endif>Hong Kong S.A.R., China</option>
                            <option value="HM" @if(old('nationality') == 'HM') selected @endif>Heard Island and McDonald Islands</option>
                            <option value="HN" @if(old('nationality') == 'HN') selected @endif>Honduras</option>
                            <option value="HR" @if(old('nationality') == 'HR') selected @endif>Croatia</option>
                            <option value="HT" @if(old('nationality') == 'HT') selected @endif>Haiti</option>
                            <option value="HU" @if(old('nationality') == 'HU') selected @endif>Hungary</option>
                            <option value="ID" @if(old('nationality') == 'ID') selected @endif>Indonesia</option>
                            <option value="IE" @if(old('nationality') == 'IE') selected @endif>Ireland</option>
                            <option value="IL" @if(old('nationality') == 'IL') selected @endif>Israel</option>
                            <option value="IM" @if(old('nationality') == 'IM') selected @endif>Isle of Man</option>
                            <option value="IN" @if(old('nationality') == 'IN') selected @endif>India</option>
                            <option value="IO" @if(old('nationality') == 'IO') selected @endif>British Indian Ocean Territory</option>
                            <option value="IQ" @if(old('nationality') == 'IQ') selected @endif>Iraq</option>
                            <option value="IR" @if(old('nationality') == 'IR') selected @endif>Iran</option>
                            <option value="IS" @if(old('nationality') == 'IS') selected @endif>Iceland</option>
                            <option value="IT" @if(old('nationality') == 'IT') selected @endif>Italy</option>
                            <option value="JE" @if(old('nationality') == 'JE') selected @endif>Jersey</option>
                            <option value="JM" @if(old('nationality') == 'JM') selected @endif>Jamaica</option>
                            <option value="JO" @if(old('nationality') == 'JO') selected @endif>Jordan</option>
                            <option value="JP" @if(old('nationality') == 'JP') selected @endif>Japan</option>
                            <option value="KE" @if(old('nationality') == 'KE') selected @endif>Kenya</option>
                            <option value="KG" @if(old('nationality') == 'KG') selected @endif>Kyrgyzstan</option>
                            <option value="KH" @if(old('nationality') == 'KH') selected @endif>Cambodia</option>
                            <option value="KI" @if(old('nationality') == 'KI') selected @endif>Kiribati</option>
                            <option value="KM" @if(old('nationality') == 'KM') selected @endif>Comoros</option>
                            <option value="KN" @if(old('nationality') == 'KN') selected @endif>Saint Kitts and Nevis</option>
                            <option value="KP" @if(old('nationality') == 'KP') selected @endif>North Korea</option>
                            <option value="KR" @if(old('nationality') == 'KR') selected @endif>South Korea</option>
                            <option value="KW" @if(old('nationality') == 'KW') selected @endif>Kuwait</option>
                            <option value="KY" @if(old('nationality') == 'KY') selected @endif>Cayman Islands</option>
                            <option value="KZ" @if(old('nationality') == 'KZ') selected @endif>Kazakhstan</option>
                            <option value="LA" @if(old('nationality') == 'LA') selected @endif>Laos</option>
                            <option value="LB" @if(old('nationality') == 'LB') selected @endif>Lebanon</option>
                            <option value="LC" @if(old('nationality') == 'LC') selected @endif>Saint Lucia</option>
                            <option value="LI" @if(old('nationality') == 'LI') selected @endif>Liechtenstein</option>
                            <option value="LK" @if(old('nationality') == 'LK') selected @endif>Sri Lanka</option>
                            <option value="LR" @if(old('nationality') == 'LR') selected @endif>Liberia</option>
                            <option value="LS" @if(old('nationality') == 'LS') selected @endif>Lesotho</option>
                            <option value="LT" @if(old('nationality') == 'LT') selected @endif>Lithuania</option>
                            <option value="LU" @if(old('nationality') == 'LU') selected @endif>Luxembourg</option>
                            <option value="LV" @if(old('nationality') == 'LV') selected @endif>Latvia</option>
                            <option value="LY" @if(old('nationality') == 'LY') selected @endif>Libya</option>
                            <option value="MA" @if(old('nationality') == 'MA') selected @endif>Morocco</option>
                            <option value="MC" @if(old('nationality') == 'MC') selected @endif>Monaco</option>
                            <option value="MD" @if(old('nationality') == 'MD') selected @endif>Moldova</option>
                            <option value="ME" @if(old('nationality') == 'ME') selected @endif>Montenegro</option>
                            <option value="MF" @if(old('nationality') == 'MF') selected @endif>Saint Martin (French part)</option>
                            <option value="MG" @if(old('nationality') == 'MG') selected @endif>Madagascar</option>
                            <option value="MH" @if(old('nationality') == 'MH') selected @endif>Marshall Islands</option>
                            <option value="MK" @if(old('nationality') == 'MK') selected @endif>Macedonia</option>
                            <option value="ML" @if(old('nationality') == 'ML') selected @endif>Mali</option>
                            <option value="MM" @if(old('nationality') == 'MM') selected @endif>Myanmar</option>
                            <option value="MN" @if(old('nationality') == 'MN') selected @endif>Mongolia</option>
                            <option value="MO" @if(old('nationality') == 'MO') selected @endif>Macao S.A.R., China</option>
                            <option value="MP" @if(old('nationality') == 'MP') selected @endif>Northern Mariana Islands</option>
                            <option value="MQ" @if(old('nationality') == 'MQ') selected @endif>Martinique</option>
                            <option value="MR" @if(old('nationality') == 'MR') selected @endif>Mauritania</option>
                            <option value="MS" @if(old('nationality') == 'MS') selected @endif>Montserrat</option>
                            <option value="MT" @if(old('nationality') == 'MT') selected @endif>Malta</option>
                            <option value="MU" @if(old('nationality') == 'MU') selected @endif>Mauritius</option>
                            <option value="MV" @if(old('nationality') == 'MV') selected @endif>Maldives</option>
                            <option value="MW" @if(old('nationality') == 'MW') selected @endif>Malawi</option>
                            <option value="MX" @if(old('nationality') == 'MX') selected @endif>Mexico</option>
                            <option value="MY" @if(old('nationality') == 'MY') selected @endif>Malaysia</option>
                            <option value="MZ" @if(old('nationality') == 'MZ') selected @endif>Mozambique</option>
                            <option value="NA" @if(old('nationality') == 'NA') selected @endif>Namibia</option>
                            <option value="NC" @if(old('nationality') == 'NC') selected @endif>New Caledonia</option>
                            <option value="NE" @if(old('nationality') == 'NE') selected @endif>Niger</option>
                            <option value="NF" @if(old('nationality') == 'NF') selected @endif>Norfolk Island</option>
                            <option value="NG" @if(old('nationality') == 'NG') selected @endif>Nigeria</option>
                            <option value="NI" @if(old('nationality') == 'NI') selected @endif>Nicaragua</option>
                            <option value="NL" @if(old('nationality') == 'NL') selected @endif>Netherlands</option>
                            <option value="NO" @if(old('nationality') == 'NO') selected @endif>Norway</option>
                            <option value="NP" @if(old('nationality') == 'NP') selected @endif>Nepal</option>
                            <option value="NR" @if(old('nationality') == 'NR') selected @endif>Nauru</option>
                            <option value="NU" @if(old('nationality') == 'NU') selected @endif>Niue</option>
                            <option value="NZ" @if(old('nationality') == 'NZ') selected @endif>New Zealand</option>
                            <option value="OM" @if(old('nationality') == 'OM') selected @endif>Oman</option>
                            <option value="PA" @if(old('nationality') == 'PA') selected @endif>Panama</option>
                            <option value="PE" @if(old('nationality') == 'PE') selected @endif>Peru</option>
                            <option value="PF" @if(old('nationality') == 'PF') selected @endif>French Polynesia</option>
                            <option value="PG" @if(old('nationality') == 'PG') selected @endif>Papua New Guinea</option>
                            <option value="PH" @if(old('nationality') == 'PH') selected @endif>Philippines</option>
                            <option value="PK" @if(old('nationality') == 'PK') selected @endif>Pakistan</option>
                            <option value="PL" @if(old('nationality') == 'PL') selected @endif>Poland</option>
                            <option value="PM" @if(old('nationality') == 'PM') selected @endif>Saint Pierre and Miquelon</option>
                            <option value="PN" @if(old('nationality') == 'PN') selected @endif>Pitcairn</option>
                            <option value="PR" @if(old('nationality') == 'PR') selected @endif>Puerto Rico</option>
                            <option value="PS" @if(old('nationality') == 'PS') selected @endif>Palestinian Territory</option>
                            <option value="PT" @if(old('nationality') == 'PT') selected @endif>Portugal</option>
                            <option value="PW" @if(old('nationality') == 'PW') selected @endif>Palau</option>
                            <option value="PY" @if(old('nationality') == 'PY') selected @endif>Paraguay</option>
                            <option value="QA" @if(old('nationality') == 'QA') selected @endif>Qatar</option>
                            <option value="RE" @if(old('nationality') == 'RE') selected @endif>Reunion</option>
                            <option value="RO" @if(old('nationality') == 'RO') selected @endif>Romania</option>
                            <option value="RS" @if(old('nationality') == 'RS') selected @endif>Serbia</option>
                            <option value="RU" @if(old('nationality') == 'RU') selected @endif>Russia</option>
                            <option value="RW" @if(old('nationality') == 'RW') selected @endif>Rwanda</option>
                            <option value="SA" @if(old('nationality') == 'SA') selected @endif>Saudi Arabia</option>
                            <option value="SB" @if(old('nationality') == 'SB') selected @endif>Solomon Islands</option>
                            <option value="SC" @if(old('nationality') == 'SC') selected @endif>Seychelles</option>
                            <option value="SD" @if(old('nationality') == 'SD') selected @endif>Sudan</option>
                            <option value="SE" @if(old('nationality') == 'SE') selected @endif>Sweden</option>
                            <option value="SG" @if(old('nationality') == 'SG') selected @endif>Singapore</option>
                            <option value="SH" @if(old('nationality') == 'SH') selected @endif>Saint Helena</option>
                            <option value="SI" @if(old('nationality') == 'SI') selected @endif>Slovenia</option>
                            <option value="SJ" @if(old('nationality') == 'SJ') selected @endif>Svalbard and Jan Mayen</option>
                            <option value="SK" @if(old('nationality') == 'SK') selected @endif>Slovakia</option>
                            <option value="SL" @if(old('nationality') == 'SL') selected @endif>Sierra Leone</option>
                            <option value="SM" @if(old('nationality') == 'SM') selected @endif>San Marino</option>
                            <option value="SN" @if(old('nationality') == 'SN') selected @endif>Senegal</option>
                            <option value="SO" @if(old('nationality') == 'SO') selected @endif>Somalia</option>
                            <option value="SR" @if(old('nationality') == 'SR') selected @endif>Suriname</option>
                            <option value="ST" @if(old('nationality') == 'ST') selected @endif>Sao Tome and Principe</option>
                            <option value="SV" @if(old('nationality') == 'SV') selected @endif>El Salvador</option>
                            <option value="SY" @if(old('nationality') == 'SY') selected @endif>Syria</option>
                            <option value="SZ" @if(old('nationality') == 'SZ') selected @endif>Swaziland</option>
                            <option value="TC" @if(old('nationality') == 'TC') selected @endif>Turks and Caicos Islands</option>
                            <option value="TD" @if(old('nationality') == 'TD') selected @endif>Chad</option>
                            <option value="TF" @if(old('nationality') == 'TF') selected @endif>French Southern Territories</option>
                            <option value="TG" @if(old('nationality') == 'TG') selected @endif>Togo</option>
                            <option value="TH" @if(old('nationality') == 'TH') selected @endif>Thailand</option>
                            <option value="TJ" @if(old('nationality') == 'TJ') selected @endif>Tajikistan</option>
                            <option value="TK" @if(old('nationality') == 'TK') selected @endif>Tokelau</option>
                            <option value="TL" @if(old('nationality') == 'TL') selected @endif>Timor-Leste</option>
                            <option value="TM" @if(old('nationality') == 'TM') selected @endif>Turkmenistan</option>
                            <option value="TN" @if(old('nationality') == 'TN') selected @endif>Tunisia</option>
                            <option value="TO" @if(old('nationality') == 'TO') selected @endif>Tonga</option>
                            <option value="TR" @if(old('nationality') == 'TR') selected @endif>Turkey</option>
                            <option value="TT" @if(old('nationality') == 'TT') selected @endif>Trinidad and Tobago</option>
                            <option value="TV" @if(old('nationality') == 'TV') selected @endif>Tuvalu</option>
                            <option value="TW" @if(old('nationality') == 'TW') selected @endif>Taiwan</option>
                            <option value="TZ" @if(old('nationality') == 'TZ') selected @endif>Tanzania</option>
                            <option value="UA" @if(old('nationality') == 'UA') selected @endif>Ukraine</option>
                            <option value="UG" @if(old('nationality') == 'UG') selected @endif>Uganda</option>
                            <option value="UM" @if(old('nationality') == 'UM') selected @endif>United States Minor Outlying Islands</option>
                            <option value="US" @if(old('nationality') == 'US') selected @endif>United States</option>
                            <option value="UY" @if(old('nationality') == 'UY') selected @endif>Uruguay</option>
                            <option value="UZ" @if(old('nationality') == 'UZ') selected @endif>Uzbekistan</option>
                            <option value="VA" @if(old('nationality') == 'VA') selected @endif>Vatican</option>
                            <option value="VC" @if(old('nationality') == 'VC') selected @endif>Saint Vincent and the Grenadines</option>
                            <option value="VE" @if(old('nationality') == 'VE') selected @endif>Venezuela</option>
                            <option value="VG" @if(old('nationality') == 'VG') selected @endif>British Virgin Islands</option>
                            <option value="VI" @if(old('nationality') == 'VI') selected @endif>U.S. Virgin Islands</option>
                            <option value="VN" @if(old('nationality') == 'VN') selected @endif>Vietnam</option>
                            <option value="VU" @if(old('nationality') == 'VU') selected @endif>Vanuatu</option>
                            <option value="WF" @if(old('nationality') == 'WF') selected @endif>Wallis and Futuna</option>
                            <option value="WS" @if(old('nationality') == 'WS') selected @endif>Samoa</option>
                            <option value="YE" @if(old('nationality') == 'YE') selected @endif>Yemen</option>
                            <option value="YT" @if(old('nationality') == 'YT') selected @endif>Mayotte</option>
                            <option value="ZA" @if(old('nationality') == 'ZA') selected @endif>South Africa</option>
                            <option value="ZM" @if(old('nationality') == 'ZM') selected @endif>Zambia</option>
                            <option value="ZW" @if(old('nationality') == 'ZW') selected @endif>Zimbabwe</option>
                        </select>
                        @error('nationality')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>الجنس</label>
                        <select name="gender" class="form-control">
                            <option value="" selected disabled>-----</option>
                            <option value="male" @if(old('gender')=='male') selected @endif>ذكر</option>
                            <option value="female" @if(old('gender')=='female') selected @endif>انثى</option>
                        </select>
                        @error('gender')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>المدينة</label>
                        <input name="city" value="{{old('city')}}" type="text" class="form-control" placeholder="ادخل المدينة">
                        @error('city')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label>العمر</label>
                        <input name="age" value="{{old('age')}}" type="text" class="form-control" placeholder="ادخل العمر">
                        @error('age')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>رقم الجوال</label>
                        <input name="mobile" value="{{old('mobile')}}" type="text" class="form-control" placeholder="ادخل رقم الجوال">
                        @error('mobile')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>العنوان</label>
                        <input name="address" value="{{old('address')}}" type="text" class="form-control" placeholder="ادخل العنوان">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>الحالة الاجتماعية</label>
                        <select name="marital_status" class="form-control">
                            <option value="" selected disabled>-----</option>
                            <option value="خاطب/مخطوبة" @if(old('marital_status')== 'خاطب/مخطوبة') selected @endif>خاطب/مخطوبة</option>
                            <option value="متملك/متملكة" @if(old('marital_status')== 'متملك/متملكة') selected @endif>متملك/متملكة</option>
                            <option value="سنة أولى زواج" @if(old('marital_status')== 'سنة أولى زواج') selected @endif>سنة أولى زواج</option>
                        </select>
                        @error('marital_status')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>البريد الالكتروني</label>
                        <input name="email" value="{{old('email')}}" type="text" class="form-control" placeholder="ادخل البريد الالكتروني">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label>المؤهل العلمي</label>
                        <input name="qualification" value="{{old('qualification')}}" type="text" class="form-control" placeholder="ادخل المؤهل العلمي">
                        @error('qualification')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>التخصص</label>
                        <input name="major" value="{{old('major')}}" type="text" class="form-control" placeholder="ادخل التخصص">
                        @error('major')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>جهة العمل</label>
                        <input name="job" value="{{old('job')}}" type="text" class="form-control" placeholder="ادخل جهة العمل">
                        @error('job')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>ماهي المهارات التي ترغب التطوع بها في مجال مؤهلك	</label>
                        <textarea name="skills"  class="form-control" rows="5">{{old('skills')}}</textarea>
                        @error('skills')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>هل شاركت في أعمال تطوعية سابقة؟</label>
                        <textarea name="voluntary" class="form-control" rows="5" placeholder="في حال الاجابة بنعم أرجو ذكرها :">{{old('voluntary')}}</textarea>
                        @error('voluntary')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>



                    <label>فترة العمل المناسبة</label>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="favor_time[]" type="checkbox" id="1" value="الصباحية" @if(collect(old('favor_time'))->contains('الصباحية'))checked @endif> الصباحية
                        </label>
                        <label class="checkbox-inline">
                            <input name="favor_time[]" type="checkbox" id="2" value="المسائية" @if(collect(old('favor_time'))->contains('المسائية'))checked @endif>المسائية
                        </label>
                        <label class="checkbox-inline">
                            <input name="favor_time[]" type="checkbox" id="3" value="بعد الظهر" @if(collect(old('favor_time'))->contains('بعد الظهر'))checked @endif> بعد الظهر
                        </label>
                        @error('favor_time')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">صورة بطاقة الأحوال</label>
                        <p class="help-block">هنا يوضع مكان للملاحظة من أجل الملفات المرفقة</p>
                        <div class="form-inline">
                            <div class="fileUpload btn btn-success">
                                <span>تحميل الملف</span>
                                <input name="image" id="uploadBtn" type="file" value="{{old('image')}}" class="upload">
                                @error('image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div></div>
                    </div>
                    <div class="form-group">
                        <label>اسم ولي الأمر</label>
                        <input name="parent_name" value="{{old('parent_name')}}" type="text" class="form-control" placeholder="ادخل اسم ولي الأمر">
                        @error('parent_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>بريد إلكتروني ولي الأمر	</label>
                        <input name="parent_email" value="{{old('parent_email')}}" type="text" class="form-control" placeholder="ادخل بريد إلكتروني ولي الأمر	">
                        @error('parent_email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>جوال ولي الامر</label>
                        <input name="parent_mobile" value="{{old('parent_mobile')}}" type="text" class="form-control" placeholder="ادخل جوال ولي الامر">
                        @error('parent_mobile')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>هاتف ولي الأمر</label>
                        <input name="parent_tel" value="{{old('parent_tel')}}" type="text" class="form-control" placeholder="ادخل جوال ولي الامر">
                        @error('parent_tel')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>مهنة ولي الأمر	</label>
                        <input name="parent_job" value="{{old('parent_job')}}" type="text" class="form-control" placeholder="ادخل مهنة ولي الأمر	">
                        @error('parent_job')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <label>الأيام المناسبة</label>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox1" value="1" @if(collect(old('fav_days'))->contains(1)) checked @endif>السبت
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox2" value="2" @if(collect(old('fav_days'))->contains(2)) checked @endif>الأحد
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox3" value="3" @if(collect(old('fav_days'))->contains(3)) checked @endif>الاثنين
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox4" value="4" @if(collect(old('fav_days'))->contains(4)) checked @endif>الثلاثاء
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox5" value="5" @if(collect(old('fav_days'))->contains(5)) checked @endif>الاربعاء
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox6" value="6" @if(collect(old('fav_days'))->contains(6)) checked @endif>الخميس
                        </label>
                        <label class="checkbox-inline">
                            <input name="fav_days[]" type="checkbox" id="inlineCheckbox7" value="7" @if(collect(old('fav_days'))->contains(7)) checked @endif>الجمعة
                        </label>
                        @error('fav_days')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    @if(!isset($_COOKIE['team_sent']))
                    <div class="form-group">

                    {{--  captcha                  --}}
                    </div>
                    @endif
                    <input @if(!isset($_COOKIE['team_sent'])) type="submit" @endif class="btn btn-custom pull-left" value="إدخال">
                    <br><br>
                    </form>


                    <div class="clearfix"></div>

                </div>
            </div>

            <aside>
                <div class="col-md-4">
                    <div class="sidebar">

                        <div class="arrow_box no-margin"><h3>أخر الأخبار</h3></div>
                        <ul class="news-menu margin-top-15">
                            @php
                                $all = \App\Models\Blog::where(['active'=>1,'category_id'=>2])->latest()->limit(6)->get();
                            @endphp
                            @forelse ($all as $news)
                                <li><a href="{{route('post.show',$news->slug)}}">
                                        @if ($news->image != "" && file_exists("uploads/blogs/" . $news->image))
                                            <img src="{{'../../../uploads/blogs/'.$news->image}}" class="img-responsive" />
                                        @else
                                            <img src="{{asset('admins/images/no-img.png')}}" class="img-responsive"/>
                                        @endif
                                        <h5 style="font-size: 15px;font-weight: bold;line-height: 20px !important;text-align: center">{{strlen($news->title)>100?substr($news->title,0,strpos($news->title,' ',100)).'...': $news->title}}</h5>
                                    </a></li>
                            @empty
                                <li><h3 style="text-align: center">لا يوجد أخبار لعرضها حاليا</h3></li>
                            @endforelse
                        </ul>
                        <div class="clearfix"></div>



                    </div>

                </div>
            </aside>


        </div>

    </section>

@endsection
