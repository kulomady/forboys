/* 
 * sis_function.js
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */


// add by sepryharyandi@gmail.com
function replaceall(str,replace,with_this)
{
    var str_hasil ="";
    for(var i=0;i<str.length;i++)
    {
        if (str[i] == replace)
        {
            var temp = with_this;
        }
        else
        {
            var temp = str[i];
        }
        str_hasil += temp;
    }
    var result = str_hasil.toString();
    return result;
} 