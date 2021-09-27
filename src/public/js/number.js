/************************************************
DESCRIPTION: 
	Validates that a string contains only valid integer number.
PARAMETERS:
	str - String to be tested for validity.
RETURNS:
   True if valid, otherwise false.
******************************************************************************/
function IntValid(str)
{	if (str=='') return true;

	var objRegExp  = /(^-?\d\d*$)/; 
	//check for integer characters
	return objRegExp.test(str);
}

/******************************************************************************
DESCRIPTION:
	Validates that a string contains only valid numbers.
PARAMETERS:
	str - String to be tested for validity.
RETURNS:
	True if valid, otherwise false.
******************************************************************************/
function FloatValid(str)
{	if (str=='') return true;

	var objRegExp  =  /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;
	//check for numeric characters
	return objRegExp.test(str);
}

/************************************************
DESCRIPTION:
	Validates that a string contains only
    valid dates with 2 digit month, 2 digit day, 
	4 digit year. Date separator can be ., -, or /.
    Uses combination of regular expressions and 
    string parsing to validate date.
    Ex. mm/dd/yyyy or mm-dd-yyyy or mm.dd.yyyy    
PARAMETERS:
   str - String to be tested for validity.
RETURNS:
   True if valid, otherwise false.
REMARKS:
   Avoids some of the limitations of the Date.parse()
   method such as the date separator character.
*************************************************/

function dateValid(field)
{	var dateStr = Trim(field.value);
	if (isNull(dateStr)) return true;
	
	var i = dateStr.indexOf("/");
	var j = dateStr.indexOf("/", i + 1);
	if ((i == -1) || (j == -1)) return false;
	
	var day		= parseInt(dateStr.substr(0, i), 10);
	var month	= parseInt(dateStr.substr(i + 1, (j - i - 1)), 10);
	var year	= parseInt(dateStr.substr(j + 1), 10);
	
	if ((month < 1) || (month > 12)) return false;
	
	if (isNaN(day) || isNaN(month) || isNaN(year) || (year < 0)) return false;
	

	var DOM = 31;
	switch(month)
	{	case 2:
			DOM = ((((year % 4) == 0) && ((year % 100) != 0)) || ((year % 400) == 0)) ? 29 : 28;
			break;
		case 4:
		case 6:
		case 9:
		case 11:
			DOM = 30; break;
		default:
			DOM = 31;
	}
	
	if ((day < 1) || (day > DOM)) return false;

	if (year < 30)
	{	year += 2000;
	}else if (year < 100)
	{	year += 1900;
	}
		
	field.value = ((day<10) ? ("0"+day) : day) + "/" +((month<10) ? ("0"+month) : month) + "/" + year;
	return true;
}

/************************************************
DESCRIPTION:
	Validates that a string contains only valid time.
    Ex. HH:MM or HH:MM:SS or HH:MM:SS.mmm
PARAMETERS:
   str - String to be tested for validity.
RETURNS:
   True if valid, otherwise false.
*************************************************/
function timeValid(str)
{	if (str=='') return true;
	
	var objRegExp = /^((0?[0-9])|(1[0-9])|2[0-3]):[0-5]?\d(:[0-5]?\d(\.\d{1,3})?)?$/;
	//check to see if in correct format
  	return objRegExp.test(str);
}

/************************************************
DESCRIPTION:
	Validates that a string is not all blank (whitespace) characters.
PARAMETERS:
   str - String to be tested for validity
RETURNS:
   True if valid, otherwise false.
*************************************************/
function NotEmptyValid(str)
{	return (Trim(str)!='');
}
//End check form

function Trim(str)
{	return str.replace(/^\s*|\s*$/g, '');
}

function replaceAll(content, s1, s2)
{	return content.split(s1).join(s2); //content.replace((new RegExp(s1, 'g')), s2);
}

function isNull(str)
{	if(str==null) return true;

	var iLen = str.length;
	for (var i=0; i<iLen; i++)
	{	if (str.charAt(i)!= ' ') return false;
	}
	
	return true;
}

//Format number for Vietnam 1.230,50
function addCommas(nStr)
{	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? ',' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
	}
	return x1 + x2;
}

function getObj(name) 
{   if (document.getElementById) { return document.getElementById(name); }
	else if (document.all)       { return document.all[name]; }
	else if (document.layers)    { return document.layers[name]; }
}

function changeValue(what)
{
	var _value = isNaN(parseInt(replaceAll(what.value,".","")))?0:parseInt(replaceAll(what.value,".",""));
	what.value = addCommas(_value);
}

function checkDate(field)
{	if(!dateValid(field))
	{	alert('Ngày tháng vừa nhập không hợp lệ');
		field.focus();
		field.select();
		return false;
	}
	return true;
}

function checkInt(field)
{	
	if (field.value=='') return true;
	if(isNaN(parseInt(field.value)))
	{	alert('Số nguyên không hợp lệ');
		field.focus();
		field.select();
		return false;
	}
	
	changeValue(field);
	
	return true;
}