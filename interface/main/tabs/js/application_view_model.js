

var app_view_model={};

app_view_model.application_data={};

app_view_model.application_data.tabs=new tabs_view_model();

app_view_model.application_data.patient=ko.observable(null);

app_view_model.application_data.user=ko.observable(null);

app_view_model.application_data.therapy_group=ko.observable(null);

app_view_model.attendant_template_type=ko.observable('patient-data-template');