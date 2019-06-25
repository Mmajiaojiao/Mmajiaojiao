 $(function(){
	var o = document.getElementById("times");//获取ID
	        getTime();//调用函数
	        function getTime() {
	            //获取一个截止时间  2018/7/13 12:00
	            var endDate = new Date('2019/7/13 12:00');
	            endDate = endDate.getTime();//1970-截止时间  从1970年到截止时间有多少毫秒
	            //获取一个现在的时间
	            var nowdate = new Date;
	            nowdate = nowdate.getTime(); //现在时间-截止时间  从现在到截止时间有多少毫秒
	 
	            //获取时间差 把毫秒转换为秒
	            var diff = parseInt((endDate - nowdate) / 1000);
	 
	            h = parseInt(diff / 3600);//获取还有小时
	            m = parseInt(diff / 60 % 60);//获取还有分钟
	            s = diff % 60;//获取多少秒数
	 
	            //将时分秒转化为双位数
	            h = setNum(h);
	            m = setNum(m);
	            s = setNum(s);
	            //输出时分秒
	            o.innerHTML = h + "时" + m + "分" + s + "秒";
	            setTimeout(getTime, 1000);
	 
	        }
	        //设置函数 把小于10的数字转换为两位数
	        function setNum(num) {
	            if (num < 10) {
	                num = "0" + num;
	            }
	            return num;
	        }
	  	});