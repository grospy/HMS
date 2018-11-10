

function encounter_data(id,date,category)
{
    var self=this;
    self.id=ko.observable(id);
    self.date=ko.observable(date);
    self.category=ko.observable(category);
    return this;
}

function patient_data_view_model(pname,pid,pubpid,str_dob)
{
    var self=this;
    self.pname=ko.observable(pname);
    self.pid=ko.observable(pid);
    self.pubpid=ko.observable(pubpid);
    self.str_dob=ko.observable(str_dob);
    self.patient_picture=ko.computed(function(){
      return webroot_url + '/controller.php' +
             '?document&retrieve' +
             '&patient_id=' + pid +
             '&document_id=-1' +
             '&as_file=false' +
             '&original_file=true' +
             '&disable_exit=false' +
             '&show_original=true' +
             '&context=patient_picture';
    }, self);

    self.encounterArray=ko.observableArray();
    self.selectedEncounterID=ko.observable();
    self.selectedEncounter=ko.observable();
    self.selectedEncounterID.extend({notify: 'always'});
    self.selectedEncounterID.subscribe(function(newVal)
    {
       for(var encIdx=0;encIdx<self.encounterArray().length;encIdx++)
       {
           var curEnc=self.encounterArray()[encIdx];
           if(curEnc.id()===newVal)
           {

               self.selectedEncounter(curEnc);
               return;
           }
       }
       // No valid encounter ID found, so clear selected encounter;
       self.selectedEncounter(null);
    });
    return this;
}
