<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">{{ __('Parent_trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>{{__('main_trans.Number')}}</th>
            <th>{{ __('Parent_trans.Email') }}</th>
            <th>{{ __('Parent_trans.Name_Father') }}</th>
            <th>{{ __('Parent_trans.National_ID_Father') }}</th>
            <th>{{ __('Parent_trans.Passport_ID_Father') }}</th>
            <th>{{ __('Parent_trans.Phone_Father') }}</th>
            <th>{{ __('Parent_trans.Job_Father') }}</th>
            <th>{{ __('Parent_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($my_parents as $my_parent)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $my_parent->Email }}</td>
                <td>{{ $my_parent->Name_Father }}</td>
                <td>{{ $my_parent->National_ID_Father }}</td>
                <td>{{ $my_parent->Passport_ID_Father }}</td>
                <td>{{ $my_parent->Phone_Father }}</td>
                <td>{{ $my_parent->Job_Father }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ __('Grades_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})"
                            title="{{ __('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>
