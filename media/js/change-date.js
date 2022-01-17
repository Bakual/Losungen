/**
 * @package    HerrnhuterLosungen
 * @author     Thomas Hunziker <admin@sermonspeaker.net>
 * @copyright  (C) 2022 - Thomas Hunziker
 * @license    http://www.gnu.org/licenses/gpl.html
 **/
((Joomla, document) => {
  document.addEventListener('DOMContentLoaded', () => {
    var httpRequest;
    document.getElementById('losungButtonPrev').addEventListener('click', changeLosung);
    document.getElementById('losungButtonNext').addEventListener('click', changeLosung);

    function changeLosung() {
      let ajaxURL = 'index.php?option=com_ajax&module=herrnhuter_losungen&method=getLosung&format=json';
      httpRequest = new XMLHttpRequest();
      if (!httpRequest) {
        alert('Giving up :( Cannot create an XMLHTTP instance');
        return false;
      }
      let navigation = this.dataset.losungnavigation;
      let date = document.getElementById('losungDatum').dataset.losungdatum;
      httpRequest.onreadystatechange = alertContents;
      httpRequest.open('GET', ajaxURL + '&date=' + date + '&nav=' + navigation);
      httpRequest.send();
    }

    function alertContents() {
      if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status === 200) {
          let jsonResponse = JSON.parse(httpRequest.responseText);
          let data = jsonResponse['data'];
          document.getElementById("losungDatum").dataset.losungdatum = data['DatumUS'];
          document.getElementById("losungDatum").innerHTML = data['DatumFormatiert'];
          document.getElementById("losungsText").innerHTML = data['LosungstextFormatiert'];
          document.getElementById("losungsVers").innerHTML = data['Losungsverslink'];
          document.getElementById("lehrText").innerHTML = data['LehrtextFormatiert'];
          document.getElementById("lehrTextVers").innerHTML = data['Lehrtextverslink'];
        } else {
          alert('There was a problem with the request.');
        }
      }
    }
  })
})(window.Joomla, document);
