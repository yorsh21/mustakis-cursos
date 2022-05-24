<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Course;
use App\Models\Commune;
use App\Models\Region;
use App\Models\Parameter;
use Carbon\Carbon;

class User extends Authenticatable
{
    const AUTH_DOC = 'auth_doc';
    const SCHOOL_DOC = 'school_doc';
    const AUTH_DOC2 = 'auth_doc2';
    const SCHOOL_DOC2 = 'school_doc2';
    const CESSION_DOC = 'cession_doc';
    const LICENSE_STUDENT = 'license_student';
    const LICENSE_TUTOR = 'license_tutor';
    const RECOMENDATION_DOC = 'recomendation_doc';
    const SERVICE_TO_STUDENT = 'service_to_student';
    
    use Notifiable;

    protected  $fillable = [
        'firstname', 'lastname', 'email', 'rut', 'password', 'birth_date', 'genere', 'nationality', 'phone_number', 'phone_number2', 
        'address', 'email_tutor', 'email_teacher', 'auth_doc', 'school_doc', 'course', 'cession_doc', 'license_student', 'license_tutor', 
        'recomendation_doc', 'service_to_student', 'establishment', 'commune_establishment_student', 'dependency_establishment_student', 
        'type_establishment_student', 'especiality', 'transport_establishment', 'phone_number_tutor', 'special_needs', 'needs_student', 
        'average_math_notes', 'average_notes_lenguage', 'participate_before_student', 'city_assist_workshop', 'workshop_puerto_montt', 
        'horary_preference', 'about_select_workshop', 'establishment_workshop_robotic', 'first_contact_robotic', 'motivation', 'find_about_workshop', 
        'features_workshop', 'school_workshop', 'participate_school_workshop', 'participate_other_workshop', 'broadcast_first_contact', 
        'participate_tournament_robotic', 'robot_home', 'knowledge_programation', 'experience_platform', 'commune_id', 'rol_id', 'remember_token', 
        'created_at', 'updated_at', 'sha', 'doing_postulation', 'image_profile', 'score', 'score_motivation', 'education_level', 'study_career', 
        'study_institution', 'auth_doc2', 'school_doc2', 'mute', 'multiroles'
    ];


    public function rol() {
        return $this->belongsTo('App\Models\Rol');
    }

    public function division_users() {
        return $this->hasMany('App\Models\DivisionUser');
    }

    public function solicitudes() {
        return $this->hasMany('App\Models\Solicitude');
    }

    public function commune() {
        return $this->belongsTo('App\Models\Commune');
    }

    public function getNameAttribute() {
        return ucwords(mb_strtolower("{$this->firstname} {$this->lastname}", 'UTF-8'));
    }

    public function getShortFirstNameAttribute() {
        $name = explode(" ", $this->firstname)[0];
        return ucwords(mb_strtolower("{$name}", 'UTF-8'));
    }

    public function video() {
        return $this->hasMany('App\Models\Video');
    }

    public function video_comment() {
        return $this->hasMany('App\Models\VideoComment');
    }

    public function task_periods(){
        return $this->hasMany('App\Models\TaskPeriod');
    }



    public function has_rol($rol) {
        if($this->rol_id == $rol || $this->multiroles == $rol) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getShowCourseAttribute()
    {
        if($this->course == '7 basico') {
            return '7º Básico';
        }
        elseif($this->course == '8 basico') {
            return '8º Básico';
        }
        elseif($this->course == '1 medio') {
            return '1º Medio';
        }
        elseif($this->course == '2 medio') {
            return '2º Medio';
        }
        elseif($this->course == '3 medio') {
            return '3º Medio';
        }
        else {
            return 'N/A';
        }
    }

    public function getGenderAttribute()
    {
        if ($this->genere === 0) {
            return 'Masculino';
        }
        elseif ($this->genere === 1) {
            return 'Femenino';
        }
        else {
            return '';
        }
    }

    public function getImageAttribute()
    {
        if(is_null($this->image_profile)) {
            return "img/avatars/default.png";
        }
        else {
            return "img/avatars/" . $this->image_profile;
        }
    }

    public function getImageFileAttribute()
    {
        if(is_null($this->image_profile)) {
            return "default.png";
        }
        else {
            return $this->image_profile;
        }
    }


    public function getIsFillPersonalDataAttribute()
    {
        if (is_null($this->birth_date))
            $result = false;
        elseif (is_null($this->genere))
            $result = false;
        elseif (is_null($this->phone_number))
            $result = false;
        elseif (is_null($this->phone_number2))
            $result = false;
        elseif (is_null($this->address))
            $result = false;
        elseif (is_null($this->email_tutor))
            $result = false;
        elseif (is_null($this->email_teacher))
            $result = false;
        elseif (is_null($this->course))
            $result = false;
        elseif (is_null($this->phone_number_tutor))
            $result = false;
        elseif (is_null($this->commune_id))
            $result = false;
        else
            $result = true;

        return $result;
    }

    public function getIsFillDocumentacionDataAttribute()
    {
        if (is_null($this->auth_doc))
            $result = false;
        elseif (is_null($this->school_doc))
            $result = false;
        elseif (is_null($this->cession_doc))
            $result = false;
        elseif (is_null($this->license_student))
            $result = false;
        elseif (is_null($this->license_tutor))
            $result = false;
        else
            $result = true;

        return $result;
    }

    public function getIsFillEstablecimientoDataAttribute()
    {
        if (is_null($this->commune_establishment_student))
            $result = false;
        elseif (is_null($this->establishment))
            $result = false;
        elseif (is_null($this->dependency_establishment_student))
            $result = false;
        elseif (is_null($this->type_establishment_student))
            $result = false;
        elseif (is_null($this->transport_establishment))
            $result = false;
        elseif (is_null($this->special_needs))
            $result = false;
        elseif (is_null($this->city_assist_workshop))
            $result = false;
        elseif (is_null($this->horary_preference))
            $result = false;
        elseif (is_null($this->establishment_workshop_robotic))
            $result = false;
        elseif (is_null($this->first_contact_robotic))
            $result = false;
        elseif (is_null($this->broadcast_first_contact))
            $result = false;
        elseif (is_null($this->about_select_workshop))
            $result = false;
        elseif (is_null($this->doing_postulation))
            $result = false;
        else
            $result = true;

        return $result;
    }

    public function getIsFillEncuestaDataAttribute()
    {
        if (is_null($this->motivation))
            $result = false;
        elseif (is_null($this->features_workshop))
            $result = false;
        elseif (is_null($this->find_about_workshop))
            $result = false;
        elseif (is_null($this->experience_platform))
            $result = false;
        elseif (is_null($this->school_workshop))
            $result = false;
        elseif (is_null($this->participate_school_workshop))
            $result = false;
        elseif (is_null($this->participate_other_workshop))
            $result = false;
        elseif (is_null($this->participate_tournament_robotic))
            $result = false;
        elseif (is_null($this->robot_home))
            $result = false;
        elseif (is_null($this->knowledge_programation))
            $result = false;
        elseif (is_null($this->education_level))
            $result = false;
        elseif (is_null($this->study_career))
            $result = false;
        elseif (is_null($this->study_institution))
            $result = false;
        else
            $result = true;

        return $result;
    }

    public function getIsFillProfileAttribute() {
        if (
            is_null($this->birth_date) ||
            is_null($this->genere) ||
            is_null($this->phone_number) ||
            is_null($this->phone_number2) ||
            is_null($this->address) ||
            is_null($this->email_tutor) ||
            is_null($this->email_teacher) ||
            is_null($this->course) ||
            is_null($this->phone_number_tutor) ||
            is_null($this->commune_id) ||
            is_null($this->establishment) ||
            is_null($this->dependency_establishment_student) ||
            is_null($this->type_establishment_student) ||
            is_null($this->transport_establishment) ||
            is_null($this->about_select_workshop) ||
            is_null($this->city_assist_workshop)
        ) {
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }

    public function calculate_score() 
    {
        $scores = Parameter::where('type', 'scores')->pluck('value', 'key');
        $weighings = Parameter::where('type', 'weighing')->pluck('value', 'key');

        //Resetea el puntaje a cero
        $this->score = 0;
        $this->ponderation = 0;

        //Curso
        switch ($this->course) {
            case '7 basico':
                $this->score += $scores['puntaje_7_basico'];
                $this->ponderation += $scores['puntaje_7_basico'] * $weighings['ponderacion_curso'];
                break;
            case '8 basico':
                $this->score += $scores['puntaje_8_basico'];
                $this->ponderation += $scores['puntaje_8_basico'] * $weighings['ponderacion_curso'];
                break;
            case '1 medio':
                $this->score += $scores['puntaje_1_medio'];
                $this->ponderation += $scores['puntaje_1_medio'] * $weighings['ponderacion_curso'];
                break;
            case '2 medio':
                $this->score += $scores['puntaje_2_medio'];
                $this->ponderation += $scores['puntaje_2_medio'] * $weighings['ponderacion_curso'];
                break;
            case '3 medio':
                $this->score += $scores['puntaje_3_medio'];
                $this->ponderation += $scores['puntaje_3_medio'] * $weighings['ponderacion_curso'];
                break;
            case '4 medio':
                $this->score += $scores['puntaje_4_medio'];
                $this->ponderation += $scores['puntaje_4_medio'] * $weighings['ponderacion_curso'];
                break;
            default:
                break;
        }

        //Transporte
        switch ($this->transport_establishment) {
            case '0':
                $this->score += $scores['puntaje_si_transporte'];
                $this->ponderation += $scores['puntaje_si_transporte'] * $weighings['ponderacion_transporte'];
                break;
            case '1':
                $this->score += $scores['puntaje_no_transporte'];
                $this->ponderation += $scores['puntaje_no_transporte'] * $weighings['ponderacion_transporte'];
                break;
            default:
                break;
        }

        //Establecimiento
        $establishment = Course::find($this->establishment);
        if(!is_null($establishment)) {
            $this->score += $establishment->score;
            $this->ponderation += $establishment->score * $weighings['ponderacion_establecimiento'];
        }
        else {
            $this->ponderation += $scores['puntaje_no_establecimiento'] * $weighings['ponderacion_establecimiento'];
        }

        //Postulación
        switch ($this->doing_postulation) {
            case '0':
                $this->score += $scores['puntaje_propia'];
                $this->ponderation += $scores['puntaje_propia'] * $weighings['ponderacion_postulacion'];
                break;
            case '1':
                $this->score += $scores['puntaje_propia_apoderados'];
                $this->ponderation += $scores['puntaje_propia_apoderados'] * $weighings['ponderacion_postulacion'];
                break;
            case '2':
                $this->score += $scores['puntaje_propia_profesores'];
                $this->ponderation += $scores['puntaje_propia_profesores'] * $weighings['ponderacion_postulacion'];
                break;
            case '3':
                $this->score += $scores['puntaje_propia_apoderados_profesores'];
                $this->ponderation += $scores['puntaje_propia_apoderados_profesores'] * $weighings['ponderacion_postulacion'];
                break;
            default:
                break;
        }

        //Carta Motivacional
        $this->score += $this->score_motivation;
        $this->ponderation += $this->score_motivation * $weighings['ponderacion_carta_motivacional'];

        //Género
        switch ($this->genere) {
            case '0':
                $this->score += $scores['puntaje_masculino'];
                $this->ponderation += $scores['puntaje_masculino'] * $weighings['ponderacion_genero'];
                break;
            case '1':
                $this->score += $scores['puntaje_femenino'];
                $this->ponderation += $scores['puntaje_femenino'] * $weighings['ponderacion_genero'];
                break;
            default:
                break;
        }

        //Dependencia Establecimiento
        switch ($this->dependency_establishment_student) {
            case '0':
                $this->score += $scores['puntaje_establecimiento_municipal'];
                $this->ponderation += $scores['puntaje_establecimiento_municipal'] * $weighings['ponderacion_dependencia'];
                break;
            case '1':
                $this->score += $scores['puntaje_establecimiento_particular_subvencionado'];
                $this->ponderation += $scores['puntaje_establecimiento_particular_subvencionado'] * $weighings['ponderacion_dependencia'];
                break;
            case '2':
                $this->score += $scores['puntaje_establecimiento_particular'];
                $this->ponderation += $scores['puntaje_establecimiento_particular'] * $weighings['ponderacion_dependencia'];
                break;
            default:
                break;
        }

        //Tipo Establecimiento
        switch ($this->type_establishment_student) {
            case '0':
                $this->score += $scores['puntaje_tipo_cientifico'];
                $this->ponderation += $scores['puntaje_tipo_cientifico'] * $weighings['ponderacion_tipo_establecimiento'];
                break;
            case '1':
                $this->score += $scores['puntaje_tipo_tecnico'];
                $this->ponderation += $scores['puntaje_tipo_tecnico'] * $weighings['ponderacion_tipo_establecimiento'];
                break;
            case '2':
                $this->score += $scores['puntaje_tipo_n_a'];
                $this->ponderation += $scores['puntaje_tipo_n_a'] * $weighings['ponderacion_tipo_establecimiento'];
                break;
            default:
                break;
        }
    }

    public function getNameEstablishmentAttribute()
    {
        if(is_numeric($this->establishment)) {
            $establishment = Course::find($this->establishment);
            if(!is_null($establishment))
                return $establishment->name . " *";
        }
        return $this->establishment;
    }

    public function getNameRegionEstablishmentAttribute()
    {
        $commune = Region::find($this->commune_establishment_student);
        if(is_null($commune)) {
            return "";
        }
        else {
            return $commune->name;
        }
    }

    public function getLetterMotivationalAttribute()
    {
        $this->about_select_workshop = wordwrap($this->about_select_workshop, 50, PHP_EOL, 1);
        return $this->about_select_workshop;
    }

    public function getMotivationsAttribute()
    {
        $motivations = array();
        $motivations_selected = explode(",", $this->motivation);

        foreach ($motivations_selected as $motivation) {
            switch ($motivation) {
                case '0':
                    $motivations[] = 'Quiero aprender robótica con mayor profundidad';
                    break;
                case '1':
                    $motivations[] = 'Quiero mejorar mis conocimientos en ciencias';
                    break;
                case '2':
                    $motivations[] = 'Deseo tener una actividad extra programática fuera de mi colegio';
                    break;
                case '3':
                    $motivations[] = 'Fue una recomendación de mi familia';
                    break;
                case '4':
                    $motivations[] = 'Fue una recomendación de mis amigos';
                    break;
                case '5':
                    $motivations[] = 'Fue una recomendación de un profesor';
                    break;
                case '6':
                    $motivations[] = 'Para hacer nuevos amigos';
                    break;
                case '7':
                    $motivations[] = 'Para participar en una competencia de robótica';
                    break;
                case '8':
                    $motivations[] = 'Conocer la universidad';
                    break;
                case '9':
                    $motivations[] = 'Identificar mi vocación de estudios superiores';
                    break;
                default:
                    break;
            }
        }
        return $motivations;
    }


    public function getFeatureWorkshopAttribute()
    {
        $features = array();
        $features_workshop_selected = explode(",", $this->features_workshop);

        foreach ($features_workshop_selected as $feature) {
            switch ($feature) {
                case '0':
                    $features[] = 'Porque se hacen en una Universidad';
                    break;
                case '1':
                    $features[] = 'Porque me facilitan el robot';
                    break;
                case '2':
                    $features[] = 'Porque son gratuitos';
                    break;
                case '3':
                    $features[] = 'Porque me acomoda el horario';
                    break;
                case '4':
                    $features[] = 'Porque el taller es impartido por jóvenes universitarios';
                    break;
                case '5':
                    $features[] = 'Porque es un taller convarios días y horas de trabajo';
                    break;
                case '6':
                    $features[] = 'Porque nos prepara para una competencia';
                    break;
                default:
                    break;
            }
        }
        return $features;
    }

    public function getFindRoboticAttribute()
    {
        $find_about_workshop = '';
        switch ($this->find_about_workshop) {
            case '0':
                $find_about_workshop = 'Por la TV';
                break;
            case '1':
                $find_about_workshop = 'Amigos';
                break;
            case '2':
                $find_about_workshop = 'Familia';
                break;
            case '3':
                $find_about_workshop = 'Colegio';
                break;
            case '4':
                $find_about_workshop = 'Internet';
                break;
            case '5':
                $find_about_workshop = 'Libros';
                break;
            case '6':
                $find_about_workshop = 'Este será mi primer acercamiento';
                break;
            default:
                break;
        }
        return $find_about_workshop;
    }


    public function getExperienceAttribute()
    {
        $platforms = array();
        $experience_platform_selected = explode(",", $this->experience_platform);

        foreach ($experience_platform_selected as $experience) {
            switch ($experience) {
                case '0':
                    $platforms[] = 'NXC';
                    break;
                case '1':
                    $platforms[] = 'NQC';
                    break;
                case '2':
                    $platforms[] = 'NXT (Bloques)';
                    break;
                case '3':
                    $platforms[] = 'RoboctC';
                    break;
                case '4':
                    $platforms[] = 'RoboLab';
                    break;
                case '5':
                    $platforms[] = 'Arduino';
                    break;
                case '6':
                    $platforms[] = 'C';
                    break;
                case '7':
                    $platforms[] = 'C++';
                    break;
                case '8':
                    $platforms[] = 'Ninguna';
                    break;
                default:
                    break;
            }
        }
        return $platforms;
    }

    public function getCityPostulationAttribute()
    {
        $city = Commune::find($this->city_assist_workshop);
        if(is_null($city)) {
            return '';
        }
        else {
            return $city->name;
        }
    }

    public function getCanNeedsAttribute()
    {
        $special_needs = '';
        switch ($this->special_needs) {
            case '0':
                $special_needs = 'No';
                break;
            case '1':
                $special_needs = 'Si';
                break;
            default:
                break;
        }
        return $special_needs;
    }

    public function getBroadcastAttribute()
    {
        $contact = '';
        switch ($this->broadcast_first_contact) {
            case '0':
                $contact = 'Por mis profesores, ellos me invitaron a inscribirme';
                break;
            case '1':
                $contact = 'Recomendacion de mi familia';
                break;
            case '2':
                $contact = 'Invitación de amigos, compañeros de colegio';
                break;
            case '3':
                $contact = 'Aviso en los diarios';
                break;
            case '4':
                $contact = 'Redes sociales: Facebook, Twitter, etc.';
                break;
            case '5':
                $contact = 'Información en mi establecimiento educacional(afiche,diario mural)';
                break;
            case '6':
                $contact = 'Otro medio';
                break;
            default:
                break;
        }
        return $contact;
    }

    public function getDoingAttribute()
    {
        $doing_postulation = '';
        switch ($this->doing_postulation) {
            case '0':
                $doing_postulation = 'Por mi propia cuenta';
                break;
            case '1':
                $doing_postulation = 'Por mi propia cuenta y con el apoyo de mi(s) apoderado(s)';
                break;
            case '2':
                $doing_postulation = 'Por mi propia cuenta y con el apoyo de mi(s) profesor(es)';
                break;
            case '3':
                $doing_postulation = 'Por mi propia cuenta y con el apoyo de mi(s) apoderado(s) y mi(s) profesor(es)';
                break;
            default:
                break;
        }
        return $doing_postulation;
    }

    public function getEducationAttribute()
    {
        $education_level = '';
        switch ($this->education_level) {
            case '0':
                $education_level = 'No creo que llegue a completar 4º Año de Educación Media';
                break;
            case '1':
                $education_level = '4º Año de Educación Media';
                break;
            case '2':
                $education_level = 'Una carrera en un Instituto Profesional o Centro de Formación Técnica';
                break;
            case '3':
                $education_level = 'Una carrera en una Universidad';
                break;
            case '4':
                $education_level = 'Post grado en una Universidad';
                break;
            default:
                break;
        }
        return $education_level;
    }

    public function getDependencyEstablishmentAttribute()
    {
        $dependency_establishment = '';
        switch ($this->dependency_establishment_student) {
            case '0':
                $dependency_establishment = 'Municipal';
                break;
            case '1':
                $dependency_establishment = 'Particular subvencionado';
                break;
            case '2':
                $dependency_establishment = 'Particular';
                break;
            default:
                break;
        }
        return $dependency_establishment;
    }

    public function getTypeEstablishmentAttribute()
    {
        $type_establishment_student = '';
        switch ($this->type_establishment_student) {
            case '0':
                $type_establishment_student = 'Científico humanista';
                break;
            case '1':
                $type_establishment_student = 'Técnico profesional';
                break;
            case '2':
                $type_establishment_student = 'N/A';
                break;
            default:
                break;
        }
        return $type_establishment_student;
    }

    public function getEstablishmentTransportAttribute()
    {
        $transport_establishment = '';
        switch ($this->transport_establishment) {
            case '0':
                $transport_establishment = 'Si';
                break;
            case '1':
                $transport_establishment = 'No';
                break;
            default:
                break;
        }
        return $transport_establishment;
    }

    public function getPuertoMontWorksopAttribute()
    {
        $workshop_puerto_montt = '';
        switch ($this->workshop_puerto_montt) {
            case '0':
                $workshop_puerto_montt = 'Robotica Educativa';
                break;
            case '1':
                $workshop_puerto_montt = 'Tecnologias Espaciales: ArduSat';
                break;
            default:
                break;
        }
        return $workshop_puerto_montt;
    }

    public function getPreferenceHourAttribute()
    {
        $horary_preference = '';
        switch ($this->horary_preference) {
            case '0':
                $horary_preference = 'Mañana (10:00) a (13:00)';
                break;
            case '1':
                $horary_preference = 'Tarde (13:30) a (16:30)';
                break;
            default:
                break;
        }
        return $horary_preference;
    }

    public function getEstablishmentRoboticAttribute()
    {
        $establishment_workshop_robotic = '';
        switch ($this->establishment_workshop_robotic) {
            case '0':
                $establishment_workshop_robotic = 'No';
                break;
            case '1':
                $establishment_workshop_robotic = 'Si';
                break;
            default:
                break;
        }
        return $establishment_workshop_robotic;
    }

    public function getWorkshopSchoolAttribute()
    {
        $school_workshop = '';
        switch ($this->school_workshop) {
            case '0':
                $school_workshop = 'Si';
                break;
            case '1':
                $school_workshop = 'No';
                break;
            default:
                break;
        }
        return $school_workshop;
    }

    public function getParticipeWorkshopSchoolAttribute()
    {
        $participate_school_workshop = '';
        switch ($this->participate_school_workshop) {
            case '0':
                $participate_school_workshop = 'Si';
                break;
            case '1':
                $participate_school_workshop = 'No';
                break;
            default:
                break;
        }
        return $participate_school_workshop;
    }

    public function getParticipeWorkshopOtherAttribute()
    {
        $participate_other_workshop = '';
        switch ($this->participate_other_workshop) {
            case '0':
                $participate_other_workshop = 'Si';
                break;
            case '1':
                $participate_other_workshop = 'No';
                break;
            default:
                break;
        }
        return $participate_other_workshop;
    }

    public function getParticipeRobiticTournamentAttribute()
    {
        $participate_tournament_robotic = '';
        switch ($this->participate_tournament_robotic) {
            case '0':
                $participate_tournament_robotic = 'Si';
                break;
            case '1':
                $participate_tournament_robotic = 'No';
                break;
            default:
                break;
        }
        return $participate_tournament_robotic;
    }

    public function getHomeRobotAttribute()
    {
        $robot_home = '';
        switch ($this->robot_home) {
            case '0':
                $robot_home = 'Si';
                break;
            case '1':
                $robot_home = 'No';
                break;
            default:
                break;
        }
        return $robot_home;
    }

    public function getProgramationKnowledgeAttribute()
    {
        $knowledge_programation = '';
        switch ($this->knowledge_programation) {
            case '0':
                $knowledge_programation = 'Si';
                break;
            case '1':
                $knowledge_programation = 'No';
                break;
            default:
                break;
        }
        return $knowledge_programation;
    }

    public function getTextMuteAttribute() {
        $date = Carbon::now('Chile/Continental');
        if($this->mute > $date) {
            return "En mute hasta " . date_format(date_create($this->mute), 'd-m-Y H:i');
        }
        else {
            return "Sin mute";
        }
    }

    public function getIfMuteAttribute() {
        $date = Carbon::now('Chile/Continental');

        return $this->mute > $date;
    }

    public function getMultirolesNameAttribute()
    {
        $rol_name = '';
        switch ($this->multiroles) {
            case '1':
                $rol_name = 'Administrador';
                break;
            case '2':
                $rol_name = 'Coordinador';
                break;
            case '3':
                $rol_name = 'Mentor';
                break;
            case '4':
                $rol_name = 'Alumno';
                break;
            case '5':
                $rol_name = 'Voluntario';
                break;
            case '6':
                $rol_name = 'Asesor';
                break;
            default:
                break;
        }
        return $rol_name;
    }

}