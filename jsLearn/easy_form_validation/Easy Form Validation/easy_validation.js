/*
 *	OOP Javascript Form Validator
 *	=========================
 *
 *	By Chris Cross <chris@chriscrossonline.co.uk> or the182guy at www.vbforums.com
 *  Last update: 15 November 2008
 */

function Validator()
{
	//class validator - validates form input and handles displaying of any errors

	//private properties
	var _fields = Array();
	var _customFunctions = Array();
	var _errors = Array();
	var _customErrorMsgs = Array();
	var _outputType = "ALERT";
	var _outputDivId = "";
	var _defaultErrorMsg = "is invalid.";
	var _errorTemplate = _getDefaultErrorTemplate();

	//public pointers to private methods
	this.addField = addField;
	this.alertFields = alertFields;
	this.addCustomValidation = addCustomValidation;
	this.validateForm = validateForm;

	//public pointers to private propertiesee
	this.setOutputType = setOutputType;
	this.setOutputDivId = setOutputDivId;
	this.setDefaultErrorMsg = setDefaultErrorMsg;
	this.setErrorTemplate = setErrorTemplate;

	//public set functions - for setting private properties		
	function setOutputType(value)
	{
		if(value=="ALERT" || value=="DIV" || value=="BOTH")
		{
			_outputType = value;
		}
	}
	function setOutputDivId(value)
	{
		_outputDivId = value;
	}
	function setDefaultErrorMsg(value)
	{
		_defaultErrorMsg = value;
	}
	function setErrorTemplate(value)
	{
		_errorTemplate = value;
	}
	
	function addField(name, type, id, msg)
	{
		if(!msg) //msg is an optional argument, if not used it will use the default message for the type of field
		{
			var msg = "";
		}
		_fields[_fields.length] = {"name" : name, "type" : type, "handle" : document.getElementById(id), "msg" : msg};
	}
	
	function addCustomValidation(functionName, message)
	{
		_customFunctions[_customFunctions.length] = {"functionName" : functionName, "message" : message};
	}

	//debugging - display fields that have been added and stored for validation
	function alertFields()
	{
		for(i = 0; i < _fields.length; i++)
		{
			alert(_fields[i]["name"] + ", " + _fields[i]["type"] + ", " + _fields[i]["handle"].value + ", " + _fields[i]["msg"]);
		}
	}
	
	//checks fields stored, returns true/false
	//calls function to show validation errors if there are any
	function validateForm()
	{
		var foundError = false;
		var output = false;
		var msg = _defaultErrorMsg;
		
		for(i = 0; i < _fields.length; i++) //loop through all the fields that have been added
		{
			msg = _defaultErrorMsg;
			if(!_validateItem(_fields[i]["name"], _fields[i]["type"], _fields[i]["handle"], _fields[i]["msg"])) //check single field
			{				
				foundError = true;
				
				if(_fields[i]["msg"].length > 0) //check if a custom message has been added in addField() function
				{
					msg = _fields[i]["msg"];
				}
				else
				{
					msg = _fields[i]["name"] + " " + msg;
				}
				
				_errors[_errors.length] = msg; //there was an error, so add it to the errors array
			}
		}
		
		for(i = 0; i < _customFunctions.length; i++) //loop through custom fields
		{				
			if(!_validateCustomFunction(_customFunctions[i]["functionName"], _customFunctions[i]["functionName"]))
			{
				foundError = true;
				_errors[_errors.length] = _customFunctions[i]["message"];
			}
		}
		
		if(foundError)
		{
			_displayErrors();
		}
		else
		{
			output = true;
		}
		
		return output;
	}

	function _getDefaultErrorTemplate()
	{
		var t = new ErrorTemplate();
		
		t.setHeader("<h2>Error</h1><ul>");
		t.setItem("<li>{ERROR_MESSAGE}</li>");
		t.setFooter("</ul>");
		
		return t;
	}

	//produces output errors to user, either alert or write to div
	function _displayErrors()
	{
		var output = "";

		if(_outputType=="DIV" || _outputType=="BOTH")
		{
			var tHeader = _errorTemplate.getHeader();
			var tFooter = _errorTemplate.getFooter();
			var tSingleItem = _errorTemplate.getItem();
			var tItem = "";
			var output = "";
						
			for(i = 0; i < _errors.length; i++)
			{
				tItem += tSingleItem.replace("{ERROR_MESSAGE}", _errors[i]);
			}
			
			output = tHeader + tItem + tFooter;

			outputDiv = document.getElementById(_outputDivId);
			outputDiv.innerHTML = output;
		}
		if(_outputType=="ALERT" || _outputType=="BOTH")
		{
			output = "The following errors occured:\n\n";
			for(i = 0; i < _errors.length; i++)
			{
				output += " - " +  _errors[i] + "\n";
			}
			alert(output);
		}
		
	}

	//validate single field
	function _validateItem(name, type, handle, msg)
	{
		var output = false;
		var msg = _defaultErrorMsg;

		//check the type of validation
		switch(type)
		{
			case "NUMBER":
				output = _number(handle.value);
				break;
			case "DATE":
				output = _date(handle.value);
				break;
			case "BASIC":
				output = _basic(handle.value);
				break;
			case "NOT_EMPTY":
				output = _notEmpty(handle.value);
				break;
			case "EMAIL":
				output = _email(handle.value);
				break;
			case "NAME":
				output = _name(handle.value);
				break;
			/*
			case "LENGTH":
				output = _length(handle.value, extraParam1);
				msg = 'must be at least ' + extraParam1 + ' characters long.';
				break;
			*/
			case "CHECKBOX":
				output = _checkbox(handle.checked);
				break;
		}//end switch
		
		return output;
	} //end validate item
	
	function _validateCustomFunction(functionName, message)
	{
		return (functionName() ? true : false);
	}

	//raw validation functions, all return true/false
	function _number(value)
	{
		var output = false;
		if(value!=="")
		{
			if(!isNaN(value))
			{
				output = true;
			}	
		}
		return output;
	}
	function _date(value)
	{
		var RegEx = /^(?:(?:0?[1-9]|1\d|2[0-8])(\/|-)(?:0?[1-9]|1[0-2]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:31(\/|-)(?:0?[13578]|1[02]))|(?:(?:29|30)(\/|-)(?:0?[1,3-9]|1[0-2])))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(29(\/|-)0?2)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/;
		var regex = new RegExp(RegEx);
		return regex.test(value);
	}
	function _email(value)
	{
		var RegEx = /^([\w]+)(.[\w]+)*@([\w]+)(.[\w]{2,3}){1,2}$/;
		var regex = new RegExp(RegEx);
		return regex.test(value);
	}
	function _basic(value)
	{
		var output = false;
		output = (value.length < 3 ? false : true);
		return output;
	}
	function _notEmpty(value)
	{
		var output = false;
		output = (value.length == 0 ? false : true);
		return output;
	}
	function _name(value)
	{
		var RegEx = /^[a-zA-Z''-'\s]{1,40}$/;
		var regex = new RegExp(RegEx);
		return regex.test(value);
	}
	function _length(value, minLength)
	{
		return (value.length < minLength ? false : true);
	}
	function _checkbox(checked)
	{
		return (checked ? true : false);
	}

} //end class

function ErrorTemplate()
{
	/*
	 *  This object is needed when setting a custom error template
	 *  for the validation errors, when they are displayed in a Div
	 */
	 
	//private properties
	_header = "";
	_item = "";
	_footer = "";
	
	//public pointers to methods for set/get private properties
	this.setHeader = setHeader;
	this.setItem = setItem;
	this.setFooter = setFooter;
	
	this.getHeader = getHeader;
	this.getItem = getItem;
	this.getFooter = getFooter;
	
	function setHeader(value)
	{
		_header = value;
	}
	function getHeader()
	{
		return _header;
	}
	
	function setItem(value)
	{
		_item = value;
	}
	function getItem()
	{
		return _item;
	}
	
	function setFooter(value)
	{
		_footer = value;
	}
	function getFooter()
	{
		return _footer;
	}
	
} //end class