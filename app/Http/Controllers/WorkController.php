<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\ActivityField;
use App\Models\Company;
use App\Models\Phase;
use App\Models\Position;
use App\Models\Researcher;
use App\Models\Segment;
use App\Models\SegmentSubType;
use App\Models\Stage;
use App\Models\User;
use App\Models\Work;
use App\Models\WorkFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WorkController extends Controller
{
    protected $work;
    protected $phase;
    protected $stage;
    protected $segment;
    protected $segmentSubType;
    protected $researcher;
    protected $position;
    protected $workFeature;
    protected $activityField;
    protected $company;

    public function __construct(
        Work $work,
        Phase $phase,
        Stage $stage,
        Segment $segment,
        SegmentSubType $segmentSubType,
        Position $position,
        WorkFeature $workFeature,
        ActivityField $activityField,
        Company $company,
        Researcher $researcher
    ) {
        $this->work = $work;
        $this->phase = $phase;
        $this->stage = $stage;
        $this->segment = $segment;
        $this->segmentSubType = $segmentSubType;
        $this->researcher = $researcher;
        $this->position = $position;
        $this->workFeature = $workFeature;
        $this->activityField = $activityField;
        $this->company = $company;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = $this->work->allWorks();
        $positions = $this->position->get();
        return view('layouts.work.index', compact(
            'works',
            'positions'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $work = $this->work;
        $phases = $this->phase->get();
        $segments = $this->segment->get();
        $segmentSubTypes = old('segment_sub_type_id')
            ?  $this->segmentSubType->get()
            : [];
        $stages = old('stage_id')
            ? $this->stage->get()
            : [];
        $researchers = $this->researcher
            ->orderBy('name', 'asc')
            ->get();
        $workFeatures = $this->workFeature
            ->orderBy('description', 'asc')
            ->get();

        return view('layouts.work.create', compact(
            'work',
            'segments',
            'segmentSubTypes',
            'phases',
            'stages',
            'researchers',
            'workFeatures'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkRequest $request)
    {
        try {
            DB::beginTransaction();

            $work = $this->work;
            $work->old_code = $request->old_code;
            $work->last_review = convertPtBrDateToEnDate($request->last_review);
            $work->name = $request->name;
            $work->price = convertMaskToDecimal($request->price);
            $work->address = $request->address;
            $work->number = $request->number;
            $work->district = $request->district;
            $work->city = $request->city;
            $work->state = $request->state;
            $work->state_acronym = $request->state_acronym;
            $work->zip_code = $request->zip_code;
            $work->phase_id = $request->phase_id;
            $work->stage_id = $request->stage_id;
            $work->segment_id = $request->segment_id;
            $work->segment_sub_type_id = $request->segment_sub_type_id;
            $work->started_at = convertPtBrDateToEnDate($request->started_at);
            $work->ends_at = convertPtBrDateToEnDate($request->ends_at);
            $work->notes = $request->notes;

            $work->revision = $request->revision;
            $work->start_and_end = $request->start_and_end;
            $work->total_project_area = $request->total_project_area;
            $work->cub = $request->cub;
            $work->quotation_type = $request->quotation_type;
            $work->coin = $request->coin;
            $work->investment_standard = $request->investment_standard;

            $work->tower = $request->tower;
            $work->house = $request->house;
            $work->condominium = $request->condominium;
            $work->floor = $request->floor;
            $work->apartment_per_floor = $request->apartment_per_floor;
            $work->bedroom = $request->bedroom;
            $work->suite = $request->suite;
            $work->bathroom = $request->bathroom;
            $work->washbasin = $request->washbasin;
            $work->living_room = $request->living_room;
            $work->cup_and_kitchen = $request->cup_and_kitchen;
            $work->service_area_terrace_balcony = $request->service_area_terrace_balcony;
            $work->maid_dependency = $request->maid_dependency;
            $work->other_leisure = $request->other_leisure;
            $work->total_unities = $request->total_unities;
            $work->useful_area = $request->useful_area;
            $work->total_area = $request->total_area;
            $work->elevator = $request->elevator;
            $work->garage = $request->garage;
            $work->coverage = $request->coverage;
            $work->air_conditioner = $request->air_conditioner;
            $work->heating = $request->heating;
            $work->foundry = $request->foundry;
            $work->frame = $request->frame;
            $work->completion = $request->completion;
            $work->facade = $request->facade;
            $work->status = $request->status;

            $work->created_by = auth()->guard('web')->user()->id;
            $work->updated_by = auth()->guard('web')->user()->id;
            $work->save();

            $work->features()->sync($request->work_features);

            $researcher = $this->researcher->findOrFail($request->researcher_id);
            $work->researches()->sync($researcher);

            DB::commit();

        } catch (\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['error' => $ex->getMessage()]);
        }

        return redirect()->route('work.edit', $work->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        $phases = $this->phase->get();
        $segments = $this->segment->get();
        $segmentSubTypes = $this->segmentSubType->get();
        $stages = $this->stage->get();
        $researchers = $this->researcher->get();
        $workFeatures = $this->workFeature
            ->orderBy('description', 'asc')
            ->get();
        $activityFieldsForSearch = $this->activityField
            ->orderBy('description', 'asc')
            ->get();
        $activityFields = $this->activityField
            ->orderBy('description', 'asc')
            ->get();
            
        return view('layouts.work.edit', compact(
            'work',
            'segments',
            'segmentSubTypes',
            'phases',
            'stages',
            'researchers',
            'workFeatures',
            'activityFieldsForSearch',
            'activityFields'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkRequest  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        try {
            DB::beginTransaction();

            $work->old_code = $request->old_code;
            $work->last_review = convertPtBrDateToEnDate($request->last_review);
            $work->name = $request->name;
            $work->price = convertMaskToDecimal($request->price);
            $work->address = $request->address;
            $work->number = $request->number;
            $work->district = $request->district;
            $work->city = $request->city;
            $work->state = $request->state;
            $work->state_acronym = $request->state_acronym;
            $work->zip_code = $request->zip_code;
            $work->phase_id = $request->phase_id;
            $work->stage_id = $request->stage_id;
            $work->segment_id = $request->segment_id;
            $work->segment_sub_type_id = $request->segment_sub_type_id;
            $work->started_at = convertPtBrDateToEnDate($request->started_at);
            $work->ends_at = convertPtBrDateToEnDate($request->ends_at);
            $work->notes = $request->notes;

            $work->revision = $request->revision;
            $work->start_and_end = $request->start_and_end;
            $work->total_project_area = $request->total_project_area;
            $work->cub = $request->cub;
            $work->quotation_type = $request->quotation_type;
            $work->coin = $request->coin;
            $work->investment_standard = $request->investment_standard;

            $work->tower = $request->tower;
            $work->house = $request->house;
            $work->condominium = $request->condominium;
            $work->floor = $request->floor;
            $work->apartment_per_floor = $request->apartment_per_floor;
            $work->bedroom = $request->bedroom;
            $work->suite = $request->suite;
            $work->bathroom = $request->bathroom;
            $work->washbasin = $request->washbasin;
            $work->living_room = $request->living_room;
            $work->cup_and_kitchen = $request->cup_and_kitchen;
            $work->service_area_terrace_balcony = $request->service_area_terrace_balcony;
            $work->maid_dependency = $request->maid_dependency;
            $work->other_leisure = $request->other_leisure;
            $work->total_unities = $request->total_unities;
            $work->useful_area = $request->useful_area;
            $work->total_area = $request->total_area;
            $work->elevator = $request->elevator;
            $work->garage = $request->garage;
            $work->coverage = $request->coverage;
            $work->air_conditioner = $request->air_conditioner;
            $work->heating = $request->heating;
            $work->foundry = $request->foundry;
            $work->frame = $request->frame;
            $work->completion = $request->completion;
            $work->facade = $request->facade;
            $work->status = $request->status;

            $work->updated_by = auth()->guard('web')->user()->id;
            $work->save();

            $work->features()->sync($request->work_features);

            $this->applyWorkCoverImage($request, $work);

            $researcher = $this->researcher->findOrFail($request->researcher_id);
            $work->researches()->sync($researcher);

            DB::commit();

        } catch (\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['error' => $ex->getMessage()]);
        }

        return redirect()->route('work.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Work $work)
    {
        try {
            DB::beginTransaction();

            $work->delete();

            DB::commit();

        } catch (\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
        }

        return redirect()->route('work.index');
    }

    public function getCompaniesByItsActivityField(Request $request, ActivityField $activityField)
    {
        $companies = $this->company
            ->select('id', 'activity_field_id', 'cnpj', 'trading_name')
            ->whereActivityFieldId($activityField->id)
            ->where('trading_name', 'like', '%'.$request->trading_name.'%')
            ->get();

        return response()->json([
            'companies' => $companies
        ], 200);
    }

    public function bindCompanies(Request $request, Work $work)
    {
        try {
            DB::beginTransaction();
                
            $companies = $this->company
                ->select('id', 'activity_field_id', 'cnpj', 'trading_name')
                ->whereIn('id', $request->companies_list)
                ->get();

            foreach ($companies as $company) {
                $work->companyActivityFields()->attach(
                    $company->activity_field_id,
                    ['company_id' => $company->id]
                );
            }

            $work->companies()->attach($request->companies_list);

            DB::commit();

        } catch(\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
        }

        return redirect()->back();
    }

    public function unbindCompany(Request $request, Work $work, Company $company)
    {
        DB::table('activity_field_work')
            ->where('company_id', $company->id)
            ->where('work_id', $work->id)
            ->delete();
        $work->companies()->detach([$company->id]);
        return redirect()->back();
    }

    public function addCompanyActivitiesIntoWork(Request $request, Work $work, Company $company)
    {
        try {
            DB::beginTransaction();

                DB::table('activity_field_work')
                    ->where('company_id', $company->id)
                    ->where('work_id', $work->id)
                    ->delete();

                foreach (collect($request->activity_fields_list)->all() as $activityFieldsList) {
                    DB::table('activity_field_work')
                        ->insert([
                            'activity_field_id' => $activityFieldsList,
                            'work_id' => $work->id,
                            'company_id' => $company->id,
                        ]);
                }

            DB::commit();

        } catch(\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
        }

        return redirect()->back();
    }

    public function addCompanyContactsIntoWork(Request $request, Work $work, Company $company)
    {
        try {
            DB::beginTransaction();

                DB::table('contact_work')
                    ->where('company_id', $company->id)
                    ->where('work_id', $work->id)
                    ->delete();

                foreach (collect($request->contacts_list)->all() as $contactList) {
                    DB::table('contact_work')
                        ->insert([
                            'contact_id' => $contactList,
                            'work_id' => $work->id,
                            'company_id' => $company->id,
                        ]);
                }

            DB::commit();

        } catch(\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
        }

        return redirect()->back();
    }

    private function applyWorkCoverImage(Request $request, Work $work): void
    {
        // Cover upload
        if ($request->hasFile('work_image')) {

            $file = $request->file('work_image');

            $uploadedLargePhoto = $this->uploadPhoto(
                $file,
                Work::LARGE_DIR_STORAGE_PATH,
                Work::LARGE_PHOTO_IMAGE_WIDTH,
                Work::LARGE_PHOTO_IMAGE_HEIGHT,
                true,
                $work->storage_image_link
            );

            $work->fill([
                'storage_image_link' => $uploadedLargePhoto['full_storage_path'],
                'public_image_link' => $uploadedLargePhoto['full_public_path'],
            ]);
            $work->save();
        }
    }

    public function uploadPhoto(
        $file,
        $directoryName,
        $newImageWidth = 0,
        $newImageHeight = 0,
        $isUpdate = false,
        $imagePath = ''
    ) {
        if (! empty($file)) {

            if ($isUpdate) {
                $this->deleteFile($imagePath);
            }

            $fileName  = Str::random(30) . time();

            // Check if directory exists
            Storage::makeDirectory("public/{$directoryName}", 775, true);

            // Create image
            $image = \Image::make($file);

            // Create thumbnail
            // $image->fit($newImageWidth, $newImageHeight);

            // Resize image to fixed size
            $image->resize(
                $newImageWidth,
                $newImageHeight,
                function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                }
            );

            // Set a background-color for the emerging area
            // $image->resizeCanvas($newImageWidth, $newImageHeight, 'center', false, '474745');
            $image->resizeCanvas($newImageWidth, $newImageHeight, 'center', false, 'ffffff');

            // Generate full paths
            $fullStoragePath = "{$directoryName}/{$fileName}.".$file->getClientOriginalExtension();
            $fullPublicPath = "storage/{$directoryName}/{$fileName}.".$file->getClientOriginalExtension();

            // Put images into Storage and create thumbnail
            if (Storage::put($fullStoragePath, $image->stream())) {
                return [
                    'full_storage_path' => $fullStoragePath,
                    'full_public_path' => $fullPublicPath
                ];
            }

        }

        return [];
    }

    /**
     * @param  string  $imagePath  Image Storage Link
     *
     * @return bool
     */
    public function deleteFile(string $imagePath = null, $disk = null)
    {
        if ((! empty($imagePath)) || (! is_null($imagePath))) {
            
            Storage::delete($imagePath);

            if (! is_null($disk)) {
                Storage::disk($disk)->delete($imagePath);
            }

            return true;
        }

        return false;
    }
}
