<?php

namespace App\Http\Livewire;

use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\ParentAttachment;
use App\Models\Religion;
use App\Models\Type_Blood;
use Exception;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;

    public $photos;
    public $successMessage = '';
    public $catchError;
    public $show_table=true;
    public $updateMode=false;
    public $Parent_id;

    public int $currentStep = 1;
    public $Email;
    public $Password;

    //Father Information
    public $Name_Father;
    public $Name_Father_en;
    public $National_ID_Father;
    public $Passport_ID_Father;
    public $Phone_Father;
    public $Job_Father;
    public $Job_Father_en;
    public $Nationality_Father_id;
    public $Blood_Type_Father_id;
    public $Address_Father;
    public $Religion_Father_id;

    //Mother Information
    public $Name_Mother;
    public $Name_Mother_en;
    public $National_ID_Mother;
    public $Passport_ID_Mother;
    public $Phone_Mother;
    public $Job_Mother;
    public $Job_Mother_en;
    public $Nationality_Mother_id;
    public $Blood_Type_Mother_id;
    public $Address_Mother;
    public $Religion_Mother_id;


    public function render()
    {
        $data=[
            'Nationalities'=>Nationalitie::all(),
            'Type_Bloods'=>Type_Blood::all(),
            'Religions'=>Religion::all(),
            'my_parents' => My_Parent::all(),
        ];
        return view('livewire.add-parent',$data);
    }

    public function updated($propertyName)
    {
        $realTimeValidated = [
            'Email' => 'required|email',
            'Password' => 'required|min:8|max:20',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => ['regex:/^([0-9\s\-\+\(\)]*)$/', 'min:11', 'max:11'],
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => ['regex:/^([0-9\s\-\+\(\)]*)$/', 'min:11', 'max:11']
        ];
        $this->validateOnly($propertyName, $realTimeValidated);
    }

    public function firstStepSubmit()
    {
        $validatedFatherInputs = [
            'Email' => 'required|unique:my__parents,Email,' . $this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my__parents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my__parents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'. $this->id,
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ];
        $this->validate($validatedFatherInputs);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedMotherInputs = [
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ];
        $this->validate($validatedMotherInputs);
        $this->currentStep = 3;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function submitForm()
    {
        try {
            My_Parent::create([
                'Email'=> $this->Email,
                'Password'=> Hash::make($this->Password),

                //Father Information
                'Name_Father'=>['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'National_ID_Father'=>$this->National_ID_Father,
                'Passport_ID_Father'=>$this->Passport_ID_Father,
                'Phone_Father'=>$this->Phone_Father,
                'Job_Father'=>$this->Passport_ID_Father,
                'Nationality_Father_id'=>$this->Nationality_Father_id,
                'Blood_Type_Father_id'=>$this->Blood_Type_Father_id,
                'Religion_Father_id'=>$this->Religion_Father_id,
                'Address_Father'=>$this->Address_Father,

                //Mother Information
                'Name_Mother'=>['en' => $this->Name_Mother_en, 'ar' => $this->Name_Father],
                'National_ID_Mother'=>$this->National_ID_Mother,
                'Passport_ID_Mother'=>$this->Passport_ID_Mother,
                'Phone_Mother'=>$this->Phone_Mother,
                'Job_Mother'=>$this->Passport_ID_Mother,
                'Nationality_Mother_id'=>$this->Nationality_Mother_id,
                'Blood_Type_Mother_id'=>$this->Blood_Type_Mother_id,
                'Religion_Mother_id'=>$this->Religion_Mother_id,
                'Address_Mother'=>$this->Address_Mother,
            ]);

            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(),'parent_attachments');

                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => My_Parent::latest()->first()->id,
                    ]);
                }
            }
            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
        } catch (Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }

    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father = '';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father = '';
        $this->Religion_Father_id = '';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother = '';
        $this->Religion_Mother_id = '';
    }

    public function showformadd()
    {
        $this->show_table = false;
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;

        $My_Parent=My_Parent::findOrFail($id);

         $My_Parent->update([
        $this->Parent_id = $id,
        $this->Email = $My_Parent->Email,
        $this->Password = $My_Parent->Password,

         //Father Information
        $this->Name_Father = $My_Parent->getTranslation('Name_Father', 'ar'),
        $this->Name_Father_en = $My_Parent->getTranslation('Name_Father', 'en'),
        $this->Job_Father = $My_Parent->getTranslation('Job_Father', 'ar'),
        $this->Job_Father_en = $My_Parent->getTranslation('Job_Father', 'en'),
        $this->National_ID_Father =$My_Parent->National_ID_Father,
        $this->Passport_ID_Father = $My_Parent->Passport_ID_Father,
        $this->Phone_Father = $My_Parent->Phone_Father,
        $this->Nationality_Father_id = $My_Parent->Nationality_Father_id,
        $this->Blood_Type_Father_id = $My_Parent->Blood_Type_Father_id,
        $this->Address_Father =$My_Parent->Address_Father,
        $this->Religion_Father_id =$My_Parent->Religion_Father_id,

        //Mother Information
        $this->Name_Mother = $My_Parent->getTranslation('Name_Mother', 'ar'),
        $this->Name_Mother_en = $My_Parent->getTranslation('Name_Father', 'en'),
        $this->Job_Mother = $My_Parent->getTranslation('Job_Mother', 'ar'),
        $this->Job_Mother_en = $My_Parent->getTranslation('Job_Mother', 'en'),
        $this->National_ID_Mother =$My_Parent->National_ID_Mother,
        $this->Passport_ID_Mother = $My_Parent->Passport_ID_Mother,
        $this->Phone_Mother = $My_Parent->Phone_Mother,
        $this->Nationality_Mother_id = $My_Parent->Nationality_Mother_id,
        $this->Blood_Type_Mother_id = $My_Parent->Blood_Type_Mother_id,
        $this->Address_Mother =$My_Parent->Address_Mother,
        $this->Religion_Mother_id =$My_Parent->Religion_Mother_id,
         ]);
    }


    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;

    }


    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;

    }

    public function submitForm_edit()
    {
        if ($this->Parent_id)
        {
            $parent = My_Parent::findOrFail($this->Parent_id);
            $parent->update([
                //Father Information
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'National_ID_Father' => $this->National_ID_Father,
                'Email'=>$this->Email,
                'Phone_Father'=> $this->Phone_Father,
                'Job_Father->ar'=>$this->Job_Father,
                'Job_Father->en'=>$this->Job_Father_en,
                'Name_Father->ar'=>$this->Name_Father,
                'Name_Father->en'=>$this->Name_Father_en,
            ]);
        }
        return redirect()->to('/add_parent');
    }

    public function delete($id)
    {
        $parent=My_Parent::findOrFail($id);
        $parent->delete();
        return redirect()->to('/add_parent');
    }
}
