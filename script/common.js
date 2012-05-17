String.prototype.replaceAll  = function(s1,s2) 
{        
	return this.replace(new RegExp(s1,"gm"),s2);        
}   
function getMindate(day)
{
	var myDate=new Date();
	var min=new Date(myDate.getFullYear(),myDate.getMonth(),myDate.getDate()).getTime();
	var tmp_date=getOneDate(min,day,1,1);
	return tmp_date;
}
function getMaxdate(day)
{
	var myDate=new Date();
	var min=new Date(myDate.getFullYear(),myDate.getMonth(),myDate.getDate()).getTime();
	var tmp_date=getOneDate(min,day,1,1);
	return tmp_date;
}
function searchHistory()
{
	var st=_$('st').innerHTML;
	var et=_$('et').innerHTML;
	var res=campareDate(st,et);
	if(res>0)
	{
		alert('开始日期不能晚于结束日期');
	}
	else
	{
		if(res<-30*24*3600*1000)
		{
			alert('查询时间间隔不能大于30天');
		}
		else
		{
			var str = searchUrl+'df='+st.replaceAll("/",'')+'&dt='+et.replaceAll("/",'')+'&fun=searchTable';
			execfcall(str, function(){});
		}
	}
}

function campareDate(a,b)
{
	var arr=a.split("/");
	var starttime=new Date(arr[0],arr[1],arr[2]);
	var starttimes=starttime.getTime();

	var arrs=b.split("/");
	var lktime=new Date(arrs[0],arrs[1],arrs[2]);
	var lktimes=lktime.getTime();
	return (starttimes-lktimes);
}


function fixInfo(ret)
{
	_$('paytips').style.display='none';
	if(ret.code==1)//ok
	{
		if(ret.qdata!=undefined)
		{
			var myDate=new Date();
			var today=myDate.getDate();
			var faxindate,currdate;
			_$('allqcoin').innerHTML=parseInt(ret.qdata.thismonth)+parseInt(ret.qdata.topay);
			_$('topay').innerHTML=parseInt(ret.qdata.topay);
			if(today>=sendDay)
			{
				if(ret.qdata.topay>=payLimit)
				{	
					_$('paystat').className='get-q';
					_$('paystat').href='qcoin.html';
				}
				else
				{
					_$('paystat').className='get-q1';
				}
			}
			else
			{
			    _$('paystat').style.display='none';
				_$('paytips').style.display='';		
			}
		}
		currdate=new Date(myDate.getFullYear(),myDate.getMonth(),myDate.getDate()).getTime();
		faxindate=new Date(myDate.getFullYear(),myDate.getMonth(),sendDay).getTime();	
		var days=Math.abs(Math.floor((currdate-faxindate)/(24*3600*1000)));
		var str = searchUrl+'df='+getOneDate(currdate,9,1)+'&dt='+getOneDate(currdate,2,1)+'&fun=searchTable';

		_$('st').innerHTML=getOneDate(currdate,9,1,1);
		_$('et').innerHTML=getOneDate(currdate,2,1,1);
		execfcall(str, function(){});	
	}
	else if(ret.code==-1)
	{
		checkNetBar();
	}
}

function fixRecord(ret) 
{
	var str = '';
	var pay_qv=0;
	var qcoin=0;
	var trs=tableObj.getElementsByTagName('tr');
	var num=trs.length-1;
	while (num>0)
	{
		tableObj.removeChild(trs[num]);
		num--;
	}
	_$('qcoin').innerHTML=0;
	if(ret.code==1)//ok
	{
		count=ret.qcode;
		countpage=(count%pagesize==0?count/pagesize:Math.ceil(count/pagesize));
		if(count>0)
		{
			for(var i=0;i<count;i++)
			{	
				var tr=tableObj.insertRow(i+1); 
				var td1=tr.insertCell(0);
				var td2=tr.insertCell(1);
				var td3=tr.insertCell(2);
				var td4=tr.insertCell(3);
				qcoin+=ret.qdata[i].qcoin;
				td1.innerHTML=ret.qdata[i].qtime;
				td2.innerHTML=ret.qdata[i].requin;
				td3.innerHTML=ret.qdata[i].payuin;
				td4.innerHTML=ret.qdata[i].qcoin;
			}
			_$('qcoin').innerHTML=qcoin;
			toPage(1);
		}
		else
		{
			_$('page').innerHTML='上一页&nbsp;下一页</a>&nbsp;第1/1页';
		}
	}
	else if(ret.code==-1)
	{
		checkNetBar();
	}
}
function searchTable(ret) {
	var str = '';
	var pay_qv=0;
	var qcoin=0;
	var trs=tableObj.getElementsByTagName('tr');
	var num=trs.length-1;
	while (num>0)
	{
		tableObj.removeChild(trs[num]);
		num--;
	}
	_$('pay_qv').innerHTML=0;
	_$('qcoin').innerHTML=0;
	if(ret.code==1)//ok
	{
		count=ret.qcode;
		countpage=(count%pagesize==0?count/pagesize:Math.ceil(count/pagesize));
		if(count>0)
		{
			for(var i=0;i<count;i++)
			{	
				var tr=tableObj.insertRow(i+1); 
				var td1=tr.insertCell(0);
				var td2=tr.insertCell(1);
				var td3=tr.insertCell(2);
				pay_qv+=parseInt(ret.qdata[i].pay_qv);
				qcoin+=parseInt(ret.qdata[i].qcoin);
				_$('pay_qv').innerHTML=pay_qv;
				_$('qcoin').innerHTML=qcoin;
				td1.innerHTML=ret.qdata[i].date;
				td2.innerHTML=ret.qdata[i].pay_qv;
				td3.innerHTML=ret.qdata[i].qcoin;
			}
			toPage(1);
		}
		else
		{
			_$('page').innerHTML='上一页&nbsp;下一页</a>&nbsp;第1/1页';
		}
	}
}
function toPage(pno) {
	nowpage=pno;
	var page='';
	var trs = tableObj.getElementsByTagName("tr");
	var startindex=(nowpage-1)*pagesize+1;
	var endindex=startindex+pagesize;
	for(var j=1;j<=count;j++)
	{
		if(j>=startindex && j<endindex)
		{
			if(trs[j]!=undefined)trs[j].style.display = '';
		}
		else
		{
			trs[j].style.display = 'none';
		}
	}
	if(nowpage==1)
		page='上一页&nbsp;';
	else
		page='<a href="javascript:void(0)" onclick="toPage('+(nowpage-1)+');return false;">上一页</a>&nbsp;';
	if(nowpage==countpage)
		page+='下一页&nbsp;';
	else
		page+='<a href="javascript:void(0)" onclick="toPage('+(nowpage+1)+');return false;">下一页</a>&nbsp;';
	page+='第'+nowpage+'/'+countpage+'页';
	_$('page').innerHTML=page;
}
function zeroize(value, length) {
	if (!length) {
		length = 2;
	}
	value = new String(value);
	for (var i = 0, zeros = ''; i < (length - value.length); i++) {
		zeros += '0';
	}
	return zeros + value;
}

function getOneDate(startDate,day,type,showtype) {
	var pre2Day;
	if(type==1)
		pre2Day=new Date(startDate-day*24*3600*1000);
	else
		pre2Day=new Date(startDate+day*24*3600*1000);
	if(showtype==1)
	{
		var formatdate=pre2Day.getFullYear().toString()+'/'+zeroize((pre2Day.getMonth()+1).toString())+'/'+zeroize(pre2Day.getDate().toString());
	}
	else
	{
		var formatdate=pre2Day.getFullYear().toString()+zeroize((pre2Day.getMonth()+1).toString())+zeroize(pre2Day.getDate().toString());
	}
	return formatdate;
}
Date.prototype.format = function(format) {  
	var o = {  
		"M+" :this.getMonth() + 1, // month  
		"d+" :this.getDate(), // day  
		"h+" :this.getHours(), // hour  
		"m+" :this.getMinutes(), // minute  
		"s+" :this.getSeconds(), // second  
		"q+" :Math.floor((this.getMonth() + 3) / 3), // quarter  
		"S" :this.getMilliseconds()  
	}  
	if (/(y+)/.test(format)) {  
		format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));  
	}  

	for ( var k in o) {  
		if (new RegExp("(" + k + ")").test(format)) {  
			format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));  
        }  
	}  
	return format;  
} 
