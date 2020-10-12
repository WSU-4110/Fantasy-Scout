package com.example.fantasyscout.ui.analysts;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModelProviders;

import com.example.fantasyscout.R;

public class AnalystsFragment extends Fragment {

    private AnalystsViewModel analystsViewModel;

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {
        analystsViewModel =
                ViewModelProviders.of(this).get(AnalystsViewModel.class);
        View root = inflater.inflate(R.layout.fragment_analysts, container, false);
        final TextView textView = root.findViewById(R.id.text_analysts);
        analystsViewModel.getText().observe(getViewLifecycleOwner(), new Observer<String>() {
            @Override
            public void onChanged(@Nullable String s) {
                textView.setText(s);
            }
        });
        return root;
    }
}