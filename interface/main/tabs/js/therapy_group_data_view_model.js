

function encounter_data(id,date,category)
{
    var self=this;
    self.id=ko.observable(id);
    self.date=ko.observable(date);
    self.category=ko.observable(category);
    return this;
}

function therapy_group_view_model(gid,gname)
{
    var self=this;
    self.gname=ko.observable(gname);
    self.gid=ko.observable(gid);

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
