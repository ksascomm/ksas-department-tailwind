jQuery(document).ready((function(t){var e=t(".accordion-controls li button");t(".accordion-controls li button").on("click",(function(r){$control=t(this),accordionContent=$control.attr("aria-controls"),function(r){for(var a=0;a<e.length;a++)e[a]!=r&&"true"==t(e[a]).attr("aria-expanded")&&(t(e[a]).attr("aria-expanded","false"),content=t(e[a]).attr("aria-controls"),t("#"+content).attr("aria-hidden","true"),t("#"+content).css("display","none"))}($control[0]),isAriaExp=$control.attr("aria-expanded"),newAriaExp="false"==isAriaExp?"true":"false",$control.attr("aria-expanded",newAriaExp),isAriaHid=t("#"+accordionContent).attr("aria-hidden"),"true"==isAriaHid?(t("#"+accordionContent).attr("aria-hidden","false"),t("#"+accordionContent).css("display","block")):(t("#"+accordionContent).attr("aria-hidden","true"),t("#"+accordionContent).css("display","none"))})),t((function(){var e=0,r=t("a.tab");r.bind({keydown:function(a){var n=a.which||a.keyCode;n>=37&&n<=40&&(37==n||38==n?e>0?e--:e=r.length-1:39!=n&&40!=n||(e<r.length-1?e++:e=0),t(r.get(e)).click(),a.preventDefault())},click:function(n){e=t.inArray(this,r.get()),a(),n.preventDefault()}});var a=function(){r.attr({tabindex:"-1","aria-selected":"false"}).removeClass("selected"),t(".tab-panel").removeClass("current"),t(r.get(e)).attr({tabindex:"0","aria-selected":"true"}).addClass("selected").focus(),t(r.get(e)).parent().siblings().removeClass("current"),t(r.get(e)).parent().addClass("current"),t(t(r.get(e)).attr("href")).addClass("current")}})),function(){const t=document.querySelector(".tabbed"),e=t.querySelector("ul"),r=e.querySelectorAll("a"),a=t.querySelectorAll('[id^="section"]'),n=(t,e)=>{e.focus(),e.removeAttribute("tabindex"),e.setAttribute("aria-selected","true"),t.removeAttribute("aria-selected"),t.setAttribute("tabindex","-1");let n=Array.prototype.indexOf.call(r,e),i=Array.prototype.indexOf.call(r,t);a[i].hidden=!0,a[n].hidden=!1};e.setAttribute("role","tablist"),Array.prototype.forEach.call(r,((t,i)=>{t.setAttribute("role","tab"),t.setAttribute("id","tab"+(i+1)),t.setAttribute("tabindex","-1"),t.parentNode.setAttribute("role","presentation"),t.addEventListener("click",(t=>{t.preventDefault();let r=e.querySelector("[aria-selected]");t.currentTarget!==r&&n(r,t.currentTarget)})),t.addEventListener("keydown",(t=>{let e=Array.prototype.indexOf.call(r,t.currentTarget),o=37===t.which?e-1:39===t.which?e+1:40===t.which?"down":null;null!==o&&(t.preventDefault(),"down"===o?a[i].focus():r[o]&&n(t.currentTarget,r[o]))}))})),Array.prototype.forEach.call(a,((t,e)=>{t.setAttribute("role","tabpanel"),t.setAttribute("tabindex","-1");t.getAttribute("id");t.setAttribute("aria-labelledby",r[e].id),t.hidden=!0})),r[0].removeAttribute("tabindex"),r[0].setAttribute("aria-selected","true"),a[0].hidden=!1}()}));
