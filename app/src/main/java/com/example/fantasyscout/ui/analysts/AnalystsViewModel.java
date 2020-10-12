package com.example.fantasyscout.ui.analysts;

import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;
import androidx.lifecycle.ViewModel;

public class AnalystsViewModel extends ViewModel {

    private MutableLiveData<String> mText;

    public AnalystsViewModel() {
        mText = new MutableLiveData<>();
        mText.setValue("Analysts Hub");
    }

    public LiveData<String> getText() {
        return mText;
    }
}